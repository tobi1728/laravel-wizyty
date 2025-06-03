<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminDataAppointmentsController;
use App\Http\Controllers\AdminDataMedicinesController;
use App\Http\Controllers\AdminDataPrescriptionsController;
use App\Http\Controllers\AdminDataReferralsController;
use App\Http\Controllers\AdminDataSchedulesController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminUsersDataController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\DoctorAppointmentsController;
use App\Http\Controllers\PatientAppointmentFormController;
use App\Http\Controllers\PatientAppointmentsController;
use App\Http\Controllers\PrescriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ReferralController;
use App\Http\Controllers\DoctorProfileController;
use App\Http\Controllers\PatientProfileController;
use App\Http\Controllers\DoctorScheduleController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\PatientDocumentationController;

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
// Route::middleware('auth')->group(function () {
//     // Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
//     // Route::get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
//     // Route::get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');
// });

// Profile i funkcje wspólne
Route::middleware('auth')->group(function () {

    // Routing dla roli Doctor -> /doctor/
    Route::prefix('doctor')->group(function () {

        // Doktor - dashboard
        Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

        // Doktor - profil (edytuj)
        Route::prefix('profile')->group(function () {
            Route::get('/', [DoctorProfileController::class, 'edit'])->name('doctor.profile');
            Route::post('/', [DoctorProfileController::class, 'update']);
        });
        
        // Doktor - wizyty (wolne terminy | następne wizyty | historia wizyt | edytuj | usuń)
        Route::prefix('appointments')->group(function () {
            Route::get('/free', [DoctorAppointmentsController::class, 'showFreeAppointments'])->name('doctor.freeappointments');
            Route::get('/next', [DoctorAppointmentsController::class, 'showNextAppointments'])->name('doctor.nextappointments');
            Route::get('/historic', [DoctorAppointmentsController::class, 'showHistoricAppointments'])->name('doctor.historicappointments');
            Route::get('/{id}/edit', [DoctorAppointmentsController::class, 'edit'])->name('appointments.edit');
            Route::put('/{id}', [DoctorAppointmentsController::class, 'update'])->name('appointments.update');
            Route::delete('/{id}', [DoctorAppointmentsController::class, 'destroy'])->name('appointments.destroy');
        });

        // Doktor - grafik (ustaw nowy | zobacz swój grafik)
        Route::prefix('schedules')->group(function () {
            Route::get('/', [DoctorScheduleController::class, 'showAll'])->name('doctor.schedules');
            Route::get('/add', [DoctorScheduleController::class, 'addSchedule'])->name('doctor.addschedule');
            Route::post('/add', [DoctorScheduleController::class, 'postSchedule']);
        });

        // Doktor - recepty (wystawione | wystaw nową | edytuj | usuń | generuj/pobierz PDF)
        Route::prefix('prescriptions')->group(function () {
            Route::get('/', [PrescriptionController::class, 'index'])->name('prescriptions.index');
            Route::get('/addprescription', [PrescriptionController::class, 'addPrescription'])->name('prescriptions.addPrescription');
            Route::post('/store', [PrescriptionController::class, 'store'])->name('prescriptions.store');
            Route::get('/{id}', [PrescriptionController::class, 'show'])->name('prescriptions.show');
            Route::get('/{id}/edit', [PrescriptionController::class, 'edit'])->name('prescriptions.edit');
            Route::put('/{id}', [PrescriptionController::class, 'update'])->name('prescriptions.update');
            Route::delete('/{id}', [PrescriptionController::class, 'destroy'])->name('prescriptions.destroy');
            Route::get('/{id}/export', [PrescriptionController::class, 'exportPdf'])->name('prescriptions.export');
        });

        // Doktor - skierowania (wystawione | wystaw nową | edytuj | usuń | generuj/pobierz PDF)
        Route::prefix('referrals')->group(function () {
            Route::get('/', [ReferralController::class, 'index'])->name('referrals.index');
            Route::get('/create', [ReferralController::class, 'create'])->name('referrals.create');
            Route::post('/', [ReferralController::class, 'store'])->name('referrals.store');
            Route::get('/{id}/edit', [ReferralController::class, 'edit'])->name('referrals.edit');
            Route::put('/{id}', [ReferralController::class, 'update'])->name('referrals.update');
            Route::delete('/{id}', [ReferralController::class, 'destroy'])->name('referrals.destroy');
            Route::get('/{id}/pdf', [ReferralController::class, 'pdf'])->name('referrals.pdf');
        });

    });

    // Routing dla roli Patient -> /patient/
    Route::prefix('patient')->group(function () {

        // Pacjent - dashboard
        Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

        // Pacjent - profil (edytuj)
        Route::prefix('profile')->group(function () {

            Route::get('/', [PatientProfileController::class, 'edit'])->name('patient.profile');
            Route::post('/', [PatientProfileController::class, 'update']);

        });

        // Pacjent - wizyty (umów nową wizytę | następne wizyty | historia wizyt)
        Route::prefix('appointments')->group(function () {

            Route::get('/api/specializations', [PatientAppointmentFormController::class, 'getSpecializations']);
            Route::get('/api/doctors/{specialization}', [PatientAppointmentFormController::class, 'getDoctors']);
            Route::get('/api/dates/{doctorId}', [PatientAppointmentFormController::class, 'getDates']);
            Route::get('/api/hours/{doctorId}/{date}', [PatientAppointmentFormController::class, 'getHours']);
            
            Route::get('/make', [PatientAppointmentFormController::class, 'makeAppointment'])->name('patient.appointments.make');
            Route::post('/make', [PatientAppointmentFormController::class, 'postAppointment'])->name('patient.appointments.post');

            Route::get('/next', [PatientAppointmentsController::class, 'showNextAppointments'])->name('patient.appointments.next');
            Route::put('/next/{id}', [PatientAppointmentsController::class, 'cancelAppointment'])->name('patient.appointments.cancel');

            Route::get('/historic', [PatientAppointmentsController::class, 'showHistoricAppointments'])->name('patient.appointments.historic');
            Route::get('/historic/{id}/referral', [ReferralController::class, 'pdf'])->name('referrals.pdf');
            Route::get('/historic/{id}/prescription', [PrescriptionController::class, 'exportPdf'])->name('prescriptions.export');

        });

        // Pacjent - dokumentacja (moje recepty | moje skierowania)
        Route::prefix('documentation')->group(function () {

            Route::get('/myprescriptions', [PatientDocumentationController::class, 'showMyPrescriptions'])->name('patient.documentation.prescriptions');
            Route::get('/myprescriptions/{id}/prescription', [PrescriptionController::class, 'exportPdf'])->name('prescriptions.export');

            Route::get('/myreferrals', [PatientDocumentationController::class, 'showMyReferrals'])->name('patient.documentation.referrals');
            Route::get('/myreferrals/{id}/referral', [ReferralController::class, 'pdf'])->name('referrals.pdf');

        });
    });

    // Routing dla roli Admin -> /admin/
    Route::prefix('admin')->group(function () {

        // Admin - dashboard
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Admin - profil (edytuj)
        Route::prefix('profile')->group(function () {
            Route::get('/', [AdminProfileController::class, 'edit'])->name('admin.profile');
            Route::patch('/', [AdminProfileController::class, 'updateAdmin'])->name('admin.profile.update');
        });

        Route::get('/users', [AdminUsersDataController::class, 'showAllUsers'])->name('admin.users.index');

        // Admin - zarządzanie systemem
        Route::prefix('data')->group(function () {

            Route::prefix('medicines')->group(function () {
                Route::get('/', [AdminDataMedicinesController::class, 'showAllMedicine'])->name('admin.data.medicines');
                Route::delete('/{id}', [AdminDataMedicinesController::class, 'deleteMedicine'])->name('admin.data.medicines.delete');
                Route::get('/{id}/edit', [AdminDataMedicinesController::class, 'editMedicine'])->name('admin.data.editMedicine');
                Route::put('/{id}', [AdminDataMedicinesController::class, 'updateMedicine'])->name('admin.data.updateMedicine');
                Route::get('/add', [AdminDataMedicinesController::class, 'addMedicine'])->name('admin.data.addMedicine');
                Route::post('/', [AdminDataMedicinesController::class, 'createMedicine'])->name('admin.data.createMedicine');
            });

            Route::prefix('schedules')->group(function () {
                Route::get('/', [AdminDataSchedulesController::class, 'showAllSchedules'])->name('admin.data.schedules');
                Route::delete('/{id}', [AdminDataSchedulesController::class, 'deleteSchedule'])->name('admin.data.schedules.delete');
            });

            Route::prefix('appointments')->group(function () {
                Route::get('/', [AdminDataAppointmentsController::class, 'showAllAppointments'])->name('admin.data.appointments');
                Route::delete('/{id}', [AdminDataAppointmentsController::class, 'deleteMedicine'])->name('admin.data.appointments.delete');
            });

            Route::prefix('prescriptions')->group(function () {
                Route::get('/', [AdminDataPrescriptionsController::class, 'showAllPrescriptions'])->name('admin.data.prescriptions');
                Route::delete('/{id}', [AdminDataPrescriptionsController::class, 'deletePrescriptions'])->name('admin.data.prescriptions.delete');
                Route::get('/{id}/edit', [PrescriptionController::class, 'edit'])->name('admin.data.prescriptions.edit');
                Route::get('/{id}/prescription', [PrescriptionController::class, 'exportPdf'])->name('admin.data.prescriptions.export');
            });

            Route::prefix('referrals')->group(function () {
                Route::get('/', [AdminDataReferralsController::class, 'showAllReferrals'])->name('admin.data.referrals');
                Route::delete('/{id}', [AdminDataReferralsController::class, 'deleteReferrals'])->name('admin.data.referrals.delete');
                Route::get('/{id}/edit', [ReferralController::class, 'edit'])->name('admin.data.referrals.edit');
                Route::get('/{id}/pdf', [ReferralController::class, 'pdf'])->name('admin.data.referrals.pdf');
            });



        });
    });

});

// Autoryzacja
require __DIR__.'/auth.php';
