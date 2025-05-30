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

        $freeAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_status_id', 1)
            ->with('patient')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.appointments.freeappointments', compact('freeAppointments'));
    }

    public function showNextAppointments()
    {
        $doctor = Auth::user()->doctor;

        $nextAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('appointment_status_id', 2)
            ->with('patient')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.appointments.nextappointments', compact('nextAppointments'));
    }

    public function showHistoricAppointments()
    {
        $doctor = Auth::user()->doctor;

        $historicAppointments = Appointment::where('doctor_id', $doctor->id)
            ->whereNotIn('appointment_status_id', [1, 2])
            ->with('patient')
            ->with('status')
            ->orderBy('appointment_date')
            ->get();

        return view('doctor.appointments.historicappointments', compact('historicAppointments'));
 
 
    }

    public function edit($id)
{
    $appointment = Appointment::with('status')->findOrFail($id);

    $statuses = \App\Models\AppointmentStatus::all();

    return view('doctor.appointments.edit', compact('appointment', 'statuses'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'appointment_status_id' => 'required|exists:appointment_statuses,id',
        'notes' => 'nullable|string',
    ]);

    $appointment = Appointment::findOrFail($id);
    $appointment->update([
        'appointment_status_id' => $request->appointment_status_id,
        'notes' => $request->notes,
    ]);

    $backUrl = $request->input('previous_url');
    if ($backUrl && filter_var($backUrl, FILTER_VALIDATE_URL)) {
        return redirect()->to($backUrl)->with('success', 'Wizyta została zaktualizowana.');
    }

    return redirect()->route('doctor.nextappointments')->with('success', 'Wizyta została zaktualizowana.');
}


    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return redirect()->back()->with('success', 'Wizyta została usunięta.');
    }


}
