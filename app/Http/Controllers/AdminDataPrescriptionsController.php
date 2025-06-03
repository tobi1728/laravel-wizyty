<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AdminDataPrescriptionsController extends Controller
{
    public function showAllPrescriptions(Request $request)
    {
        $search = $request->query('search');
        
        $sortParam = $request->query('sort', 'issue_date|desc');
        $sortParts = explode('|', $sortParam);
        $sortBy = $sortParts[0] ?? 'issue_date';
        $sortDirection = $sortParts[1] ?? 'desc';

        $allowedSortBy = ['issue_date'];
        $allowedSortDirection = ['asc', 'desc'];

        if (!in_array($sortBy, $allowedSortBy)) {
            $sortBy = 'issue_date';
        }

        if (!in_array($sortDirection, $allowedSortDirection)) {
            $sortDirection = 'desc';
        }

        $allPrescriptions = \App\Models\Prescription::query()
            ->with('medicine')
            ->with('appointment')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->whereHas('appointment.doctor.user', function ($q) use ($search) {
                        $q->where('firstName', 'like', "%{$search}%")
                        ->orWhere('lastName', 'like', "%{$search}%");
                    })
                    ->orWhereHas('appointment.patient.user', function ($q) use ($search) {
                        $q->where('firstName', 'like', "%{$search}%")
                        ->orWhere('lastName', 'like', "%{$search}%");
                    })
                    ->orWhereHas('medicine', function ($q) use ($search) {
                        $q->where('medicine_name', 'like', "%{$search}%");
                    });
                });
            })

        ->orderBy($sortBy, $sortDirection)
        ->paginate(15)
        ->withQueryString();

        $prescriptionsSum = \App\Models\Prescription::count();

        return view('admin.data.prescriptions', compact('allPrescriptions', 'prescriptionsSum'));
    }

    public function deletePrescriptions($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();

        return redirect()->route('admin.data.prescriptions')->with('success', 'Recepta została usunięta.');
    }
}