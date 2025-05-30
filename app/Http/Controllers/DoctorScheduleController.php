<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DoctorSchedule;
use App\Models\Appointment;
use Carbon\Carbon;

class DoctorScheduleController extends Controller
{
    // Wyświetlenie wszystkich grafików lekarza
    public function showAll()
    {
        $doctor = Auth::user()->doctor;

        $schedules = DoctorSchedule::where('doctor_id', $doctor->id)
            ->orderBy('dateStart')
            ->orderBy('timeStart')
            ->get();

        return view('doctor.schedules.schedules', compact('schedules'));
    }

    // Załadowanie formularza na stronie dodawania grafiku lekarza
    public function addSchedule()
    {
        return view('doctor.schedules.addschedule');
    }

    // Wykonanie POST na formularzu na stronie dodawania grafiku lekarza
    public function postSchedule(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'time-from' => 'required|date_format:H:i',
            'time-to' => 'required|date_format:H:i',
        ]);

        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Użytkownik nie jest lekarzem.');
        }

        $doctorId = $doctor->id;

        $date = $request->input('date');
        $timeStart = $request->input('time-from');
        $timeEnd = $request->input('time-to');

        $schedule = DoctorSchedule::create([
            'doctor_id' => $doctorId,
            'dateStart' => $date,
            'dateEnd' => $date,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
        ]);

        $start = Carbon::createFromFormat('Y-m-d H:i', "$date $timeStart");
        $end = Carbon::createFromFormat('Y-m-d H:i', "$date $timeEnd");

        while ($start < $end) {
            Appointment::create([
                'doctor_id' => $doctorId,
                'appointment_date' => $start,
                'appointment_status_id' => 1,
            ]);

            $start->addMinutes(30);
        }

        return back()->with('success', 'Grafik i wizyty zostały dodane.');
    }
}
