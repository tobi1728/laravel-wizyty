<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;

class DoctorProfileController extends Controller
{
    public function edit()
    {
        $doctor = Auth::user()->doctor;

        return view('doctor.profile', compact('doctor'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|max:255',
        ]);

        $doctor = Auth::user()->doctor;
        $doctor->update($request->only(['specialization', 'license_number']));

        return back()->with('success', 'Dane lekarza zostały zaktualizowane.');
    }
}
