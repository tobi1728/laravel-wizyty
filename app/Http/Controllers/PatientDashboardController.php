<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Referral;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class PatientDashboardController extends Controller
{
    public function index()
    {
        $patient = Auth::user()->patient;

        $nextAppointment = \App\Models\Appointment::where('patient_id', $patient->id)
            ->where('appointment_status_id', 2)
            ->with('doctor')
            ->with('status')
            ->orderBy('appointment_date')
            ->first();

        $lastAppointment = \App\Models\Appointment::where('patient_id', $patient->id)
            ->whereNotIn('appointment_status_id', [1, 2])
            ->with('doctor')
            ->with('status')
            ->orderBy('appointment_date', 'desc')
            ->first();

        return view('patient.dashboard', compact(
            'nextAppointment',
            'lastAppointment'
        ));
    }

}
