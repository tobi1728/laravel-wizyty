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
            'license_number' => [
                'nullable',
                'string',
                'regex:/^[A-Z]{2}[0-9]{6}$/'
            ],
        ], [
            'license_number.regex' => 'Numer licencji musi składać się z 2 dużych liter i 6 cyfr, np. AB123456.',
        ]);

        $doctor = Auth::user()->doctor;
        $doctor->update($request->only(['specialization', 'license_number']));

        return back()->with('success', 'Dane lekarza zostały zaktualizowane.');
    }
}
