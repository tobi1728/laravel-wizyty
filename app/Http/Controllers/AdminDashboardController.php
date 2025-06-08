<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Referral;
use App\Models\Appointment;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Medicine;
use Illuminate\Support\Facades\Auth;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $allPatientsCount = \App\Models\Patient::count();

        $lastPatient = \App\Models\Patient::orderBy('id', 'desc')
            ->first();

        $allMedicinesCount = \App\Models\Medicine::count();

        $lastMedicine = \App\Models\Medicine::orderBy('id', 'desc')
            ->first();

        $allDoctorsCount = \App\Models\Doctor::count();

        $lastDoctor = \App\Models\Doctor::orderBy('id', 'desc')
            ->first();

        $allAppointmentsCount = \App\Models\Appointment::count();

        $lastAppointment = \App\Models\Appointment::orderBy('id', 'desc')
            ->with('status')
            ->first();

        if ($lastAppointment) {
            $appointmentDate = \Carbon\Carbon::parse($lastAppointment->appointment_date)->format('Y-m-d');

            $appointmentTime = \Carbon\Carbon::parse($lastAppointment->appointment_date)->format('H:i');
        }

        return view('admin.dashboard', compact(
            'allPatientsCount',
            'lastPatient',
            'allMedicinesCount',
            'lastMedicine',
            'allDoctorsCount',
            'lastDoctor',
            'allAppointmentsCount',
            'lastAppointment',
            'appointmentDate',
            'appointmentTime'));
    }

}
