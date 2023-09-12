<?php

use App\Http\Controllers\Patient\AppointmentController;
use App\Http\Controllers\Patient\PatientController;

Route::prefix('patient')->middleware(['auth', 'role:patient'])->group(function () {
    Route::get('/dasboard', [PatientController::class, 'index'])->name('patients.dashboard');
    Route::get('/profile', [PatientController::class, 'profile'])->name('patients.profile');

    Route::get('/appointments', [AppointmentController::class, 'index'])->name('patients.appointments.index');
    Route::get('/appointments/{schedule}/', [AppointmentController::class, 'create'])->name('patients.appointments.create');
    Route::post('/appointments', [AppointmentController::class, 'store'])->name('patients.appointments.store');
});
