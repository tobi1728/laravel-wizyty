<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Patient;

class PatientProfileController extends Controller
{
    public function edit()
    {
        $patient = Auth::user()->patient;

        return view('patient.profile', compact('patient'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'pesel' => 'nullable|string|max:11',
            'birth_date' => 'nullable|date',
            'phone_number' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
        ]);

        $patient = Auth::user()->patient;
        $patient->update($request->only(['pesel', 'birth_date', 'phone_number', 'address']));

        return back()->with('success', 'Dane pacjenta zostały zaktualizowane.');
    }
}
