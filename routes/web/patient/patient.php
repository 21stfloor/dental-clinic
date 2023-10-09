<?php

use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\RecordController;

Route::prefix('patient')->middleware(['auth', 'role:patient'])->group(function () {
    // Route::get('/dashboard', [PatientController::class, 'index'])->name('patients.dashboard');
    Route::get('/dashboard', [AppointmentController::class, 'upcoming'])->name('patients.appointments.upcoming');
    Route::get('/profile', [PatientController::class, 'profile'])->name('patients.profile');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('patients.appointments.index');
    Route::match(['get', 'post'], '/appointments/create', [AppointmentController::class, 'create'])->name('patients.appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('patients.appointments.store');
    Route::get('/myrecords', [RecordController::class, 'myrecords'])->name('patients.records.myrecords');
    Route::put('/cancel-appointment/{id}', [AppointmentController::class, 'cancel'])->name('patients.appointments.cancel');
    
});
