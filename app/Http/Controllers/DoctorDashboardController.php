<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use App\Models\Referral;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorDashboardController extends Controller
{
    public function index()
{
    $doctor = Auth::user()->doctor;

    $referralCount = Referral::whereHas('appointment', function ($q) use ($doctor) {
        $q->where('doctor_id', $doctor->id);
    })->count();

    $prescriptionCount = Prescription::whereHas('appointment', function ($q) use ($doctor) {
        $q->where('doctor_id', $doctor->id);
    })->count();

    $nextAppointment = Appointment::where('doctor_id', $doctor->id)
        ->where('appointment_status_id', 2) // zaplanowane
        ->with('patient.user')
        ->orderBy('appointment_date')
        ->first();

    $freeAppointmentsCount = Appointment::where('doctor_id', $doctor->id)
        ->where('appointment_status_id', 1)
        ->count();

    $plannedAppointmentsCount = Appointment::where('doctor_id', $doctor->id)
        ->where('appointment_status_id', 2)
        ->count();

    $today = now()->toDateString();

    $todayAppointments = Appointment::where('doctor_id', $doctor->id)
        ->whereDate('appointment_date', $today)
        ->with('patient.user', 'status')
        ->orderBy('appointment_date')
        ->paginate(3);

    $historicAppointments = Appointment::where('doctor_id', $doctor->id)
        ->whereNotIn('appointment_status_id', [1, 2]) // nie wolna, nie zaplanowana
        ->with('patient.user', 'status')
        ->orderByDesc('appointment_date')
        ->take(5)
        ->get();

    $todaySchedule = $doctor->schedules()
        ->whereDate('dateStart', $today)
        ->first();

    return view('doctor.dashboard', compact(
        'prescriptionCount',
        'referralCount',
        'nextAppointment',
        'freeAppointmentsCount',
        'plannedAppointmentsCount',
        'todayAppointments',
        'historicAppointments',
        'todaySchedule'
    ));
}

}
