<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Strona powitalna
Route::get('/', function () {
    return view('welcome');
});

// Dashboard: przekierowanie zależne od roli
Route::middleware('auth')->get('/dashboard', function () {
    $role = Auth::user()->role;

    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'doctor' => redirect()->route('doctor.dashboard'),
        default => redirect()->route('patient.dashboard'),
    };
})->name('dashboard');

// Osobne panele dla ról – wskazują na admin/dashboard.blade.php itd.
Route::middleware('auth')->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
    Route::view('/doctor/dashboard', 'doctor.dashboard')->name('doctor.dashboard');
    Route::view('/patient/dashboard', 'patient.dashboard')->name('patient.dashboard');
});

// Profile osobno dla ról
Route::middleware('auth')->group(function () {
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    Route::get('/doctor/profile', [App\Http\Controllers\DoctorProfileController::class, 'edit'])->name('doctor.profile');
    Route::post('/doctor/profile', [App\Http\Controllers\DoctorProfileController::class, 'update']);

    Route::get('/patient/profile', [App\Http\Controllers\PatientProfileController::class, 'edit'])->name('patient.profile');
    Route::post('/patient/profile', [App\Http\Controllers\PatientProfileController::class, 'update']);

    Route::get('/doctor/visits', [App\Http\Controllers\DoctorProfileController::class, 'show'])->name('doctor.visits');
});

// // Panel profilu
Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::patch('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');

});

// Trasy logowania/rejestracji
require __DIR__.'/auth.php';
