<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\Medicine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AdminDataAppointmentsController extends Controller
{
    public function showAllAppointments(Request $request)
    {
        $status = $request->query('status');
        $search = $request->query('search');
        
        $sortParam = $request->query('sort', 'appointment_date|asc');
        $sortParts = explode('|', $sortParam);
        $sortBy = $sortParts[0] ?? 'appointment_date';
        $sortDirection = $sortParts[1] ?? 'asc';

        $allowedSortBy = ['appointment_date'];
        $allowedSortDirection = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'appointment_date';
        }

        if (!in_array($sortDirection, $allowedSortDirection)) {
            $sortDirection = 'asc';
        }

        $allAppointments = \App\Models\Appointment::query()
            ->with('doctor.user')
            ->with('patient.user')
            ->with('status')
            ->when($status, function ($q) use ($status) {
                $q->whereHas('status', function ($query) use ($status) {
                    $query->where('appointmentStatusName', $status);
                });
            })
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->whereHas('doctor.user', function ($q) use ($search) {
                        $q->where('firstName', 'like', "%{$search}%")
                            ->orWhere('lastName', 'like', "%{$search}%");
                    })
                    ->orWhereHas('patient.user', function ($q) use ($search) {
                        $q->where('firstName', 'like', "%{$search}%")
                            ->orWhere('lastName', 'like', "%{$search}%");
                    });
                });
            })
        ->orderBy($sortBy, $sortDirection)
        ->paginate(15)
        ->withQueryString();

        $appointmentsSum = \App\Models\Appointment::count();

        return view('admin.data.appointments', compact('allAppointments', 'appointmentsSum'));
    }

    public function deleteSchedule($id)
    {
        $schedule = DoctorSchedule::findOrFail($id);

        try {
            $schedule->delete();
            return redirect()
                ->route('admin.data.schedules')
                ->with('success', 'Grafik został usunięty.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000')
                return redirect()
                    ->route('admin.data.schedules')
                    ->with('error', 'Nie można usunąć grafiku, ponieważ istnieją powiązane wizyty.');
        }

        return redirect()
            ->route('admin.data.schedules')
            ->with('error', 'Wystąpił nieoczekiwany błąd podczas usuwania grafiku.');
    }
}