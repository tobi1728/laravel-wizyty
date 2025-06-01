<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class PatientAppointmentsController extends Controller
{
    // widok przyszłych wizyt
    public function showNextAppointments()
    {
        $patient = Auth::user()->patient;

        $nextAppointments = \App\Models\Appointment::where('patient_id', $patient->id)
            ->where('appointment_status_id', 2)
            ->with('doctor')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('patient.appointments.next', compact('nextAppointments'));
    }

    // akcja odwołania wizyty
    public function cancelAppointment(Request $request, $id)
    {
        // wyszukujemy wizytę i takim id w tablie appointments
        $appointment = Appointment::findOrFail($id);

        // Pobierz użytkownika z sesji
        $user = Auth::user();

        $patient = $user->patient; // Używamy ID pacjenta z tabeli users

        if (!$patient) {
            abort(403, 'Tylko pacjent może odwołać wizytę.');
        }

        // weryfikujemy czy wizyta na pewno ma status "wolna" - czy nie ma przypisanego użytkownika
        if ($appointment->patient_id !== $patient->id) {
            return back()->with('error', 'Ta wizyta nie należy do Ciebie - nie możesz jej odwołać.');
        }

        // przypisanie do zmiennych wartości przesłanych z formularza
        $appointment->patient_id = null;
        $appointment->appointment_status_id = 3;
        $appointment->save();

        return back()->with('success', 'Wizyta została odwołana.');
    }

    public function showHistoricAppointments()
    {
        $patient = Auth::user()->patient;

        $historicAppointments = \App\Models\Appointment::where('patient_id', $patient->id)
            ->whereNotIn('appointment_status_id', [1, 2])
            ->with('doctor')
            ->with('status')
            ->with('referrals')
            ->with('prescriptions')
            ->orderBy('appointment_date')
            ->get();

        return view('patient.appointments.historic', compact('historicAppointments'));
    }



}
