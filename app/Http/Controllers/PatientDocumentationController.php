<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;
use Carbon\Carbon;

class PatientDocumentationController extends Controller
{
    public function showMyPrescriptions()
    {
        $patient = Auth::user()->patient;

        $prescriptions = \App\Models\Prescription::whereHas('appointment', function ($q) use ($patient) {
            $q->where('patient_id', $patient->id);
        })
        ->with('appointment.doctor')
        ->with('medicine')
        ->orderBy('issue_date', 'desc')
        ->get();

        $prescriptionSum = $prescriptions->count();

        return view('patient.documentation.prescriptions', compact('prescriptions', 'prescriptionSum'));
    }

    public function showMyReferrals()
    {
        $patient = Auth::user()->patient;

        $referrals = \App\Models\Referral::whereHas('appointment', function ($q) use ($patient) {
            $q->where('patient_id', $patient->id);
        })
        ->with('appointment.doctor')
        ->orderBy('issue_date', 'desc')
        ->get();

        $referralSum = $referrals->count();

        return view('patient.documentation.referrals', compact('referrals', 'referralSum'));
    }



}
