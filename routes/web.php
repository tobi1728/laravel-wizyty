<?php

use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\DoctorAppointmentsController;
use App\Http\Controllers\PatientAppointmentFormController;
use App\Http\Controllers\PatientAppointmentsController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\DoctorScheduleController;

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

// Panele główne dla ról
Route::middleware('auth')->group(function () {
    Route::view('/admin/dashboard', 'admin.dashboard')->name('admin.dashboard');
Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
    Route::view('/patient/dashboard', 'patient.dashboard')->name('patient.dashboard');
});

// Profile i funkcje wspólne
Route::middleware('auth')->group(function () {
    // Profile
    Route::get('/admin/profile', function () {
        return view('admin.profile');
    })->name('admin.profile');

    Route::patch('/admin/profile', [ProfileController::class, 'updateAdmin'])->name('admin.profile.update');

    Route::get('/doctor/profile', [DoctorProfileController::class, 'edit'])->name('doctor.profile');
    Route::post('/doctor/profile', [DoctorProfileController::class, 'update']);

    Route::get('/patient/profile', [PatientProfileController::class, 'edit'])->name('patient.profile');
    Route::post('/patient/profile', [PatientProfileController::class, 'update']);

    // Dodatkowe dane lekarza
    Route::get('/doctor/visits', [DoctorProfileController::class, 'show'])->name('doctor.visits');

    // Grafik
    Route::get('/doctor/addschedule', [DoctorScheduleController::class, 'addSchedule'])->name('doctor.addschedule');
    Route::post('/doctor/addschedule', [DoctorScheduleController::class, 'postSchedule']);
    Route::get('/doctor/schedules', [DoctorScheduleController::class, 'showAll'])->name('doctor.schedules');

    // Recepty
    Route::prefix('doctor/prescriptions')->group(function () {
        Route::get('/', [PrescriptionController::class, 'index'])->name('prescriptions.index');
        Route::get('/addprescription', [PrescriptionController::class, 'addPrescription'])->name('prescriptions.addPrescription');
        Route::post('/store', [PrescriptionController::class, 'store'])->name('prescriptions.store');
        Route::get('/{id}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
        Route::get('/{id}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
        Route::put('/{id}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
        Route::delete('/{id}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
        Route::get('/{id}/export', [PrescriptionController::class, 'exportPdf'])->name('prescriptions.export');
    });

    // Skierowania
Route::prefix('doctor/referrals')->group(function () {
    Route::get('/', [ReferralController::class, 'index'])->name('referrals.index');
    Route::get('/create', [ReferralController::class, 'create'])->name('referrals.create');
    Route::post('/', [ReferralController::class, 'store'])->name('referrals.store');
    Route::get('/{id}/edit', [ReferralController::class, 'edit'])->name('referrals.edit');
    Route::put('/{id}', [ReferralController::class, 'update'])->name('referrals.update');
    Route::delete('/{id}', [ReferralController::class, 'destroy'])->name('referrals.destroy');
    Route::get('/{id}/pdf', [ReferralController::class, 'pdf'])->name('referrals.pdf');
});

// Wizyty
Route::prefix('doctor/appointments')->group(function () {
    Route::get('/free', [DoctorAppointmentsController::class, 'showFreeAppointments'])->name('doctor.freeappointments');
    Route::get('/next', [DoctorAppointmentsController::class, 'showNextAppointments'])->name('doctor.nextappointments');
    Route::get('/historic', [DoctorAppointmentsController::class, 'showHistoricAppointments'])->name('doctor.historicappointments');
    Route::get('/doctor/appointments/free', [DoctorAppointmentsController::class, 'showFreeAppointments'])->name('doctor.freeappointments');
    Route::get('/doctor/appointments/next', [DoctorAppointmentsController::class, 'showNextAppointments'])->name('doctor.nextappointments');
    Route::get('/doctor/appointments/historic', [DoctorAppointmentsController::class, 'showHistoricAppointments'])->name('doctor.historicappointments');

});

    Route::prefix('patient/appointments')->group(function () {

        Route::get('/api/specializations', [PatientAppointmentFormController::class, 'getSpecializations']);
        Route::get('/api/doctors/{specialization}', [PatientAppointmentFormController::class, 'getDoctors']);
        Route::get('/api/dates/{doctorId}', [PatientAppointmentFormController::class, 'getDates']);
        Route::get('/api/hours/{doctorId}/{date}', [PatientAppointmentFormController::class, 'getHours']);
        
        Route::get('/make', [PatientAppointmentFormController::class, 'makeAppointment'])->name('patient.appointments.make');
        Route::post('/make', [PatientAppointmentFormController::class, 'postAppointment'])->name('patient.appointments.post');

        Route::get('/next', [PatientAppointmentsController::class, 'showNextAppointments'])->name('patient.appointments.next');
        Route::put('/next/{id}', [PatientAppointmentsController::class, 'cancelAppointment'])->name('patient.appointments.cancel');

    });

    Route::get('/{id}/edit', [DoctorAppointmentsController::class, 'edit'])->name('appointments.edit');
    Route::put('/{id}', [DoctorAppointmentsController::class, 'update'])->name('appointments.update');
    Route::delete('/{id}', [DoctorAppointmentsController::class, 'destroy'])->name('appointments.destroy');
});

// Autoryzacja
require __DIR__.'/auth.php';
