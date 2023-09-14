<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Schedule;

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
        return response(view('doctor.profile'));
    }
}
