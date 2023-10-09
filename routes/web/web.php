<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.index');
})->middleware('guest');

Route::get('/services', [ServiceController::class, 'index'])->middleware('guest');

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

// routes/web.php

Route::middleware(['auth', 'web', 'verified'])->group(function () {
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::middleware(['role:admin'])->group(function () {
        Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admins.dashboard');
    });

    Route::middleware(['role:patient'])->group(function () {
        Route::get('/patient/dashboard', [PatientController::class, 'index'])->name('patients.appointments.upcoming');
    });

    Route::middleware(['role:doctor'])->group(function () {
        Route::get('/doctor/dashboard', 'DoctorController@index')->name('doctors.dashboard');
    });
});


require __DIR__ . '/admin/admin.php';
require __DIR__ . '/auth/auth.php';
require __DIR__ . '/patient/patient.php';
require __DIR__ . '/doctor/doctor.php';


