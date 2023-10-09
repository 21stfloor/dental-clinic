<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DoctorController extends Controller
{
    public function index(): Response
    {
        $doctor = Auth::user();

        if ($doctor) {
            $doctorId = $doctor->id;

            // Count appointments for each status for the authenticated doctor
            $pendingAppointments = Appointment::where('status', 'Pending')
                ->where('doctor_id', $doctorId)
                ->count();

            $acceptedAppointments = Appointment::where('status', 'Accepted')
                ->where('doctor_id', $doctorId)
                ->count();

            $ongoingAppointments = Appointment::where('status', 'Ongoing')
                ->where('doctor_id', $doctorId)
                ->count();

            $doneAppointments = Appointment::where('status', 'Done')
                ->where('doctor_id', $doctorId)
                ->count();

            $cancelledAppointments = Appointment::where('status', 'Cancel')
                ->where('doctor_id', $doctorId)
                ->count();
        } else {
            // Handle the case where the user is not authenticated as a doctor
            // For example, you can set these counts to 0 or handle the error as needed.
            $pendingAppointments = 0;
            $acceptedAppointments = 0;
            $ongoingAppointments = 0;
            $doneAppointments = 0;
            $cancelledAppointments = 0;
        }
        
        return response(view('doctor.index', compact('pendingAppointments', 'acceptedAppointments', 'ongoingAppointments', 'doneAppointments', 'cancelledAppointments')));
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

    public function getDoctorsByScheduleDate(Request $request)
    {
        $selectedDate = $request->input('date');

        // Parse the selected date using Carbon
        $parsedDate = Carbon::createFromFormat('Y-m-d H:i', $selectedDate);

        // Get the day of the week (0 = Sunday, 1 = Monday, ..., 6 = Saturday)
        $selectedDayOfWeek = $parsedDate->dayOfWeek;

        // Define an array to map day of the week names to their numeric values
        $dayOfWeekMap = [
            'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
        ];

        // $doctors = Doctor::whereHas('schedules', function ($query) use ($dayOfWeekMap, $selectedDayOfWeek) {
        //     // Assuming 'date' in schedules table is in the same format
        //     $query->where('day', $dayOfWeekMap[$selectedDayOfWeek]);
        // })
        // ->join('users', 'doctors.user_id', '=', 'users.id') // Join the users table
        // ->select('doctors.*', 'users.avatar', 'users.email') // Select the doctor fields and user's avatar
        // ->get();
        $doctors = Doctor::whereHas('schedules', function ($query) use ($dayOfWeekMap, $selectedDayOfWeek) {
            // Assuming 'date' in schedules table is in the same format
            $query->where('day', $dayOfWeekMap[$selectedDayOfWeek]);
        })
        ->join('users', 'doctors.user_id', '=', 'users.id') // Join the users table
        ->join('schedules', 'doctors.id', '=', 'schedules.doctor_id') // Join the schedules table
        ->select('doctors.*', 'users.avatar', 'users.email', 'schedules.id as schedule_id')
        ->get();

        return response()->json($doctors);
    }

}
