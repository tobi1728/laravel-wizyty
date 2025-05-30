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
        $doctor = Auth::user()->doctor; // Pobranie lekarza powiązanego z aktualnie zalogowanym użytkownikiem

        $schedules = DoctorSchedule::where('doctor_id', $doctor->id)
            ->orderBy('dateStart')
            ->orderBy('timeStart')
            ->get();

        return view('doctor.schedules', compact('schedules'));
    }

    // Załadowanie formularza na stronie dodawania grafiku lekarza
    public function addSchedule()
    {
        return view('doctor.addschedule');
    }

    // Wykonanie POST na formularzu na stronie dodawania grafiku lekarza
    public function postSchedule(Request $request)
    {
        // to są nazwy pól formularza
        $request->validate([
            'date' => 'required|date',
            'time-from' => 'required|date_format:H:i',
            'time-to' => 'required|date_format:H:i',
        ]);

        // Pobierz lekarza przypisanego do użytkownika
        $doctor = Auth::user()->doctor;

        if (!$doctor) {
            abort(403, 'Użytkownik nie jest lekarzem.');
        }

        $doctorId = $doctor->id; // Używamy ID lekarza z tabeli doctors

        // przypisanie do zmiennych wartości przesłanych z formularza
        $date = $request->input('date');
        $timeStart = $request->input('time-from');
        $timeEnd = $request->input('time-to');

        // tworzymy grafik lekarza w tabeli DoctorSchedule w DB (DoctorSchedule = model w Laravel odnoszący się do tej tabeli)
        $schedule = DoctorSchedule::create([
            'doctor_id' => $doctorId,
            'dateStart' => $date,
            'dateEnd' => $date,
            'timeStart' => $timeStart,
            'timeEnd' => $timeEnd,
        ]);

        // zmienne potrzebne do manipulowania godzinami z biblioteką Carbon
        $start = Carbon::createFromFormat('Y-m-d H:i', "$date $timeStart");
        $end = Carbon::createFromFormat('Y-m-d H:i', "$date $timeEnd");

        // pętla - stworzenie wizyt co 30 minut - od godziny początkowej podanej w formularzu, do pół godziny przed godziną końcową z formularza (jak do 12:00 to ostatnia to 11:30)
        // status wizyty na sztywno ustawiony na id = 1 = 'wolna'
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
