<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorAppointmentsController extends Controller
{
    public function showFreeAppointments()
    {
        $doctor = Auth::user()->doctor;

        $freeAppointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_status_id', 1)
            ->with('patient.user')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.freeappointments', compact('freeAppointments'));
    }

    public function showNextAppointments()
    {
        $doctor = Auth::user()->doctor;

        $nextAppointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_status_id', 2)
            ->with('patient.user')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.nextappointments', compact('nextAppointments'));
    }

    public function showHistoricAppointments()
    {
        $doctor = Auth::user()->doctor;

        $historicAppointments = \App\Models\Appointment::where('doctor_id', $doctor->id)
            ->whereNotIn('appointment_status_id', [1, 2])
            ->with('patient.user')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.historicappointments', compact('historicAppointments'));
    }



}
