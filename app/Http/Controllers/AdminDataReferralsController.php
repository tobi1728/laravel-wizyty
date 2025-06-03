<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use App\Models\DoctorSchedule;
use App\Models\Medicine;
use App\Models\Prescription;
use App\Models\Referral;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;

class AdminDataReferralsController extends Controller
{
    public function showAllReferrals(Request $request)
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

        $allReferrals = \App\Models\Referral::query()
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
                    ->orWhere('target_specialization', 'like', "%{$search}%");
                });
            })

        ->orderBy($sortBy, $sortDirection)
        ->paginate(15)
        ->withQueryString();

        $referralsSum = \App\Models\Referral::count();

        return view('admin.data.referrals', compact('allReferrals', 'referralsSum'));
    }

    public function deleteReferrals($id)
    {
        $referral = Referral::findOrFail($id);
        $referral->delete();

        return redirect()->route('admin.data.referrals')->with('success', 'Skierowanie zostało usunięte.');
    }
}