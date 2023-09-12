<?php

use App\Http\Controllers\Doctor\DoctorController;
use App\Http\Controllers\Doctor\ScheduleController;

Route::prefix('doctor')->middleware(['auth', 'role:doctor'])->group(function () {
    Route::get('/dashboard', [DoctorController::class, 'index'])->name('doctors.dashboard');
    Route::get('/profile', [DoctorController::class, 'profile'])->name('doctors.profile');

    Route::get('/schedules', [ScheduleController::class, 'index'])->name('doctors.schedules.index');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('doctors.schedules.store');
    Route::put('/schedules/{schedule}/update', [ScheduleController::class, 'update'])->name('doctors.schedules.update');
    Route::put('/schedules/{schedule}/active', [ScheduleController::class, 'active'])->name('doctors.schedules.active');
    Route::put('/schedules/{schedule}/inactive', [ScheduleController::class, 'inactive'])->name('doctors.schedules.inactive');
    Route::delete('/schedules/{schedule}/destroy', [ScheduleController::class, 'destroy'])->name('doctors.schedules.destroy');
});
