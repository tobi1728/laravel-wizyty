<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class ReferralController extends Controller
{
    public function index()
    {
        $doctor = Auth::user()->doctor;

        $referrals = Referral::whereHas('appointment', function ($query) use ($doctor) {
            $query->where('doctor_id', $doctor->id);
        })->with('appointment.patient')->get();

        return view('doctor.referrals.indexreferral', compact('referrals'));
    }

    public function create()
    {
        $doctor = Auth::user()->doctor;

        $appointments = Appointment::where('doctor_id', $doctor->id)
            ->with('patient')
            ->orderByDesc('appointment_date')
            ->get();

        $specializations = [
            'Kardiologia', 'Neurologia', 'Ortopedia', 'Okulistyka', 'Dermatologia'
        ];

        return view('doctor.referrals.addreferral', compact('appointments', 'specializations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
            'target_specialization' => 'required|string|max:255',
            'custom_specialization' => 'nullable|string|max:255',
            'reason' => 'nullable|string|max:1000'
        ]);

        $specialization = $request->target_specialization === 'custom'
            ? $request->custom_specialization
            : $request->target_specialization;

        Referral::create([
            'appointment_id' => $request->appointment_id,
            'refferal_code' => 'SRF-' . strtoupper(uniqid()),
            'target_specialization' => $specialization,
            'reason' => $request->reason ?? '',
            'issue_date' => now(),
        ]);

        return redirect()->route('referrals.index')->with('success', 'Skierowanie zostało wystawione.');
    }

    public function edit($id)
    {
        $referral = Referral::with('appointment.patient')->findOrFail($id);

        $specializations = [
            'Kardiologia', 'Neurologia', 'Ortopedia', 'Okulistyka', 'Dermatologia'
        ];

        return view('doctor.referrals.editreferral', compact('referral', 'specializations'));
    }

    public function update(Request $request, $id)
    {
        $referral = Referral::findOrFail($id);

        $specialization = $request->target_specialization === 'custom'
            ? $request->custom_specialization
            : $request->target_specialization;

        $referral->update([
            'target_specialization' => $specialization,
            'reason' => $request->reason,
        ]);

        if (Auth::user()->role === 'doctor') {
            return redirect()->route('referrals.index')->with('success', 'Skierowanie zostało zaktualizowane.');
        } elseif (Auth::user()->role === 'admin') {
            return redirect()->route('admin.data.referrals')->with('success', 'Skierowanie zostało zaktualizowane.');
        } else {
            abort(403, 'Brak uprawnień do wykonania tej operacji.');
        }
    }

    public function destroy($id)
    {
        $referral = Referral::findOrFail($id);
        $referral->delete();

        return redirect()->route('referrals.index')->with('success', 'Skierowanie zostało usunięte.');
    }

    public function pdf($id)
    {
        $user = Auth::user();

        $referral = Referral::with('appointment.patient')->findOrFail($id);

        if ($user->role === 'patient') {
            $patient = $user->patient;

            if (!$patient || $referral->appointment->patient_id !== $patient->id) {
                abort(403, 'Nie masz dostępu do tego skierowania.');
            }
        }

        $pdf = Pdf::loadView('doctor.referrals.pdfreferral', compact('referral'));

        return $pdf->stream('skierowanie.pdf');
    }
}