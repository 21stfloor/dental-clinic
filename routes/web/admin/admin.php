<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\PatientController as AdminPatientController;
use App\Http\Controllers\Admin\PermissionController as AdminPermissionController;
use App\Http\Controllers\Admin\RoleController as AdminRoleController;

Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admins.dashboard');
    Route::get('/profile', [AdminController::class, 'profile'])->name('admins.profile');

    Route::get('/doctors', [AdminDoctorController::class, 'index'])->name('doctors.index');
    Route::get('/doctors/create', [AdminDoctorController::class, 'create'])->name('doctors.create');
    Route::post('/doctors', [AdminDoctorController::class, 'store'])->name('doctors.store');
    Route::get('/doctors/{doctor}/edit', [AdminDoctorController::class, 'edit'])->name('doctors.edit');    
    Route::delete('/doctors/{doctor}/destroy', [AdminDoctorController::class, 'destroy'])->name('doctors.destroy');

    Route::get('/patients', [AdminPatientController::class, 'index'])->name('patients.index');
    Route::get('/patients/create', [AdminPatientController::class, 'create'])->name('patients.create');
    Route::post('/patients', [AdminPatientController::class, 'store'])->name('patients.store');
    Route::get('/patients/{patient}/edit', [AdminPatientController::class, 'edit'])->name('patients.edit');
    
    Route::delete('/patients/{patient}/destroy', [AdminPatientController::class, 'destroy'])->name('patients.destroy');

    Route::get('/roles', [AdminRoleController::class, 'index'])->name('roles.index');
    Route::post('/roles', [AdminRoleController::class, 'store'])->name('roles.store');
    Route::put('/roles/{role}/update', [AdminRoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/{role}/destroy', [AdminRoleController::class, 'destroy'])->name('roles.destroy');
    /*  Route::put('/roles/{role}/attach', [RoleController::class, 'attach_permission'])->name('role.permission.attach');
    Route::put('/roles/{role}/detach', [RoleController::class, 'detach_permission'])->name('role.permission.detach');
     */
    Route::get('/permissions', [AdminPermissionController::class, 'index'])->name('permissions.index');
    Route::post('/permissions', [AdminPermissionController::class, 'store'])->name('permissions.store');
    Route::put('/permissions/{permission}/update', [AdminPermissionController::class, 'update'])->name('permissions.update');
    Route::delete('/permissions/{permission}/destroy', [AdminPermissionController::class, 'destroy'])->name('permissions.destroy');

    Route::put('/doctors/{doctor}/admin-update', [AdminDoctorController::class, 'adminUpdate'])->name('doctors.admin.update');
});

Route::put('/patients/{patient}/update', [AdminPatientController::class, 'update'])->name('patients.update');
Route::put('/doctors/{doctor}/update', [AdminDoctorController::class, 'update'])->name('doctors.update');

