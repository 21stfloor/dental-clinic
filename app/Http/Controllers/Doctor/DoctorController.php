<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    public function index(): Response
    {
        $pendingAppointments = Appointment::where('status', 'pending')->count();
        $completedAppointments = Appointment::where('status', 'completed')->count();
        $cancelledAppointments = Appointment::where('status', 'cancelled')->count();
        return response(view('doctor.index', compact('pendingAppointments', 'completedAppointments', 'cancelledAppointments')));
    }

    public function profile(): Response
    {
        $doctor = Auth::user();

        if (!Auth::check()) {
            return response()->json([ 'error' => 'UnAuthorized.'], 401);
        }

        $username = Auth::user()->username;
        $doctorProfile = Doctor::where('user_id', $doctor->id)->first();

        return response(view('doctor.profile', compact('doctor', 'doctorProfile')));
    }
}
