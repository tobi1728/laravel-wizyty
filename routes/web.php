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

// Panel profilu
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Trasy logowania/rejestracji
require __DIR__.'/auth.php';
