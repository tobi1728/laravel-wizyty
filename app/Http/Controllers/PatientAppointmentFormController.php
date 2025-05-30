<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use App\Models\Doctor;
use Carbon\Carbon;

class PatientAppointmentFormController extends Controller
{
    // utworzenie endpointów api, aby dynamicznie odwoływać się do formularza i pól select
    public function getSpecializations()
    {
        return Doctor::select('specialization')->distinct()->pluck('specialization');
    }

    public function getDoctors($specialization)
    {
        return Doctor::where('specialization', $specialization)
            ->with('user:id,firstName,lastName')
            ->get()
            ->map(function ($doc) {
                return [
                    'id' => $doc->id,
                    'name' => $doc->user->firstName . ' ' . $doc->user->lastName,
                ];
            });
    }

    public function getDates($doctorId)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_status_id', 1)
            ->orderBy('appointment_date')
            ->pluck('appointment_date')
            ->map(fn($dt) => \Carbon\Carbon::parse($dt)->format('Y-m-d'))
            ->unique()
            ->values();
    }

    public function getHours($doctorId, $date)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->whereDate('appointment_date', $date)
            ->where('appointment_status_id', 1)
            ->orderBy('appointment_date')
            ->get(['id', 'appointment_date']) // pobieramy ID i datę
            ->map(fn($a) => [
                'id' => $a->id,
                'time' => \Carbon\Carbon::parse($a->appointment_date)->format('H:i'),
            ]);
    }



    // Załadowanie formularza na stronie dodawania grafiku lekarza
    public function makeAppointment()
    {
        return view('patient.appointments.make');
    }

    // Wykonanie POST na formularzu na stronie dodawania grafiku lekarza
    public function postAppointment(Request $request)
    {
        // to są nazwy pól formularza
        $request->validate([
            'appointment_id' => 'required|exists:appointments,id',
        ]);

        // Pobierz użytkownika z sesji
        $user = Auth::user();

        $patient = $user->patient; // Używamy ID pacjenta z tabeli users

        if (!$patient) {
            abort(403, 'Tylko pacjent może umawiać wizytę.');
        }

        // wyszukujemy wizytę i takim id w tablie appointments
        $appointment = Appointment::find($request->appointment_id);

        // weryfikujemy czy wizyta na pewno ma status "wolna" - czy nie ma przypisanego użytkownika
        if ($appointment->patient_id !== null) {
            return back()->with('error', 'Wizytę zarezerwował inny pacjent.');
        }

        // przypisanie do zmiennych wartości przesłanych z formularza
        $appointment->patient_id = $patient->id;
        $appointment->appointment_status_id = 2;
        $appointment->save();

        return back()->with('success', 'Wizyta została umówiona.');
    }
}
