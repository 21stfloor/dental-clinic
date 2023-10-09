<?php

use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\ScheduleController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\Patient\AppointmentController;

Route::prefix('doctor')->middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('doctors.dashboard');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('doctors.profile');
    // Route::post('/update-profile', [DoctorController::class, 'profile'])->name('doctors.profile');
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('doctors.schedules.index');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('doctors.schedules.store');
    Route::put('/schedules/{schedule}/update', [ScheduleController::class, 'update'])->name('doctors.schedules.update');
    Route::put('/schedules/{schedule}/active', [ScheduleController::class, 'active'])->name('doctors.schedules.active');
    Route::put('/schedules/{schedule}/inactive', [ScheduleController::class, 'inactive'])->name('doctors.schedules.inactive');
    Route::delete('/schedules/{schedule}/destroy', [ScheduleController::class, 'destroy'])->name('doctors.schedules.destroy');
    Route::get('/records', [RecordController::class, 'records'])->name('doctors.records.records');
    Route::post('/create-record', [RecordController::class, 'create'])->name('doctors.records.create');
    Route::delete('/delete-record/{id}', [RecordController::class, 'deleteRecord'])->name('doctors.records.delete');
    Route::get('/appointments', [AppointmentController::class, 'doctorAppointments'])->name('patients.appointments.doctor');
    Route::put('/update-appointment-status/{id}', [AppointmentController::class, 'updateStatus'])->name('doctors.appointments.update');
    Route::get('/calendar', [ScheduleController::class, 'calendar'])->name('doctors.schedules.calendar');
});
