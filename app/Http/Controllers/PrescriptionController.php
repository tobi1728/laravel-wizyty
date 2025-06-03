<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Appointment;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PrescriptionController extends Controller
{
    public function addPrescription()
    {
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Nieprawidłowy dostęp.');
        }

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->orderBy('appointment_date')
            ->get();

        $medicines = Medicine::orderBy('medicine_name')->get();

        return view('doctor.prescriptions.addprescription', compact('appointments', 'medicines'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'medicine_id' => 'required|exists:medicines,id',
            'issue_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        do {
            $generatedCode = random_int(1000, 9999);
        } while (Prescription::where('prescription_code', $generatedCode)->exists());

        Prescription::create([
            'appointment_id' => $request->appointment_id,
            'medicine_id' => $request->medicine_id,
            'prescription_code' => $generatedCode,
            'issue_date' => $request->issue_date,
            'notes' => $request->notes,
        ]);

        return redirect()->route('prescriptions.index')->with('success', 'Recepta została wystawiona.');
    }

    public function index()
    {
        $doctor = Auth::user()->doctor;

        $prescriptions = Prescription::whereHas('appointment', function ($q) use ($doctor) {
            $q->where('doctor_id', $doctor->id);
        })->with('medicine')->orderByDesc('issue_date')->get();

        return view('doctor.prescriptions.index', compact('prescriptions'));
    }

    public function show($id)
    {
        $prescription = Prescription::with('medicine', 'appointment')->findOrFail($id);
        return view('doctor.prescriptions.show', compact('prescription'));
    }

    public function edit($id)
    {
        $prescription = Prescription::findOrFail($id);
        $medicines = Medicine::orderBy('medicine_name')->get();
        return view('doctor.prescriptions.edit', compact('prescription', 'medicines'));
    }

    public function update(Request $request, $id)
    {
        $prescription = Prescription::findOrFail($id);

        $request->validate([
            'medicine_id' => 'required|exists:medicines,id',
            'issue_date' => 'required|date',
            'notes' => 'nullable|string',
        ]);

        $prescription->update([
            'medicine_id' => $request->medicine_id,
            'issue_date' => $request->issue_date,
            'notes' => $request->notes,
        ]);

        if (Auth::user()->role === 'doctor') {
            return redirect()->route('prescriptions.index')->with('success', 'Recepta została zaktualizowana.');
        } elseif (Auth::user()->role === 'admin') {
            return redirect()->route('admin.data.prescriptions')->with('success', 'Recepta została zaktualizowana.');
        } else {
            abort(403, 'Brak uprawnień do wykonania tej operacji.');
        }
    }

    public function destroy($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();

        return redirect()->route('prescriptions.index')->with('success', 'Recepta została usunięta.');
    }

    // public function exportPdf($id)
    // {
    //     $prescription = Prescription::with(['medicine', 'appointment.doctor.user', 'appointment.patient.user'])
    //         ->findOrFail($id);

    //     return \Barryvdh\DomPDF\Facade\Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'))
    //         ->stream('recepta_'.$prescription->prescription_code.'.pdf');
    // }

    public function exportPdf($id)
    {
        $user = Auth::user();

        $prescription = Prescription::with(['medicine', 'appointment.doctor.user', 'appointment.patient.user'])
            ->findOrFail($id);

        if ($user->role === 'patient') {
            $patient = $user->patient;

            if (!$patient || $prescription->appointment->patient_id !== $patient->id) {
                abort(403, 'Nie masz dostępu do tej recepty.');
            }
        }

        $pdf = Pdf::loadView('doctor.prescriptions.pdf', compact('prescription'));

        return $pdf->stream('recepta_'.$prescription->prescription_code.'.pdf');
    }
}
