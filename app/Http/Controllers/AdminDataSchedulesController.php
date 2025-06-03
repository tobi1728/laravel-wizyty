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

class AdminDataSchedulesController extends Controller
{
    public function showAllSchedules(Request $request)
    {
        $search = $request->query('search');
        
        $sortParam = $request->query('sort', 'dateStart|asc');
        $sortParts = explode('|', $sortParam);
        $sortBy = $sortParts[0] ?? 'dateStart';
        $sortDirection = $sortParts[1] ?? 'asc';

        $allowedSortBy = ['dateStart', 'dateEnd'];
        $allowedSortDirection = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'dateStart';
        }

        if (!in_array($sortDirection, $allowedSortDirection)) {
            $sortDirection = 'asc';
        }

        $allSchedules = \App\Models\DoctorSchedule::query()
            ->with('doctor.user')
            ->when($search, function ($q) use ($search) {
                $q->whereHas('doctor.user', function ($q) use ($search) {
                    $q->where('firstName', 'like', "%{$search}%")
                    ->orWhere('lastName', 'like', "%{$search}%");
                });
            })

        ->orderBy($sortBy, $sortDirection)
        ->paginate(15)
        ->withQueryString();

        $schedulesSum = \App\Models\DoctorSchedule::count();

        return view('admin.data.schedules', compact('allSchedules', 'schedulesSum'));
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