<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Rules\StartTimeNotLessThanEndTime;


use function Laravel\Prompts\alert;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $schedules = Schedule::where('doctor_id', auth()->user()->doctor->id)->get();

        return response(view('doctor.schedule.index', compact('schedules')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'day' => ['required', 'date', 'allowed_day'],
            'start_time' => 'required',
            'end_time' => ['required', new StartTimeNotLessThanEndTime],
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors(['day' => 'Invalid.'])
                ->withInput();

                return response()->json(['error.']);
        }

        Auth::user()->doctor->schedules()->create([
            'day' => Carbon::parse($request['day'])->format('l'),
            'start_time' => $request['start_time'],
            'end_time' => $request['end_time'],
            'status' => 'active',
        ]);

        // If validation passes, continue with your logic here
        return redirect()->route('doctors.schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Schedule $schedule): RedirectResponse
    {
        $validatedData = request()->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        $schedule->update($validatedData);

        if ($schedule->wasChanged()) {
            return redirect()->route('doctors.schedules.index')->with('success', 'Schedule updated successfully.');
        } else {
            return back()->with('info', 'Nothing has changed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Schedule $schedule)
    {
        $this->authorize('delete', $schedule);

        $schedule->delete();

        return redirect()->route('doctors.schedules.index')->with('success', 'Schedule deleted successfully');
    }

    public function active(Schedule $schedule)
    {
        $schedule->status = 'active';
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule has been marked as active.');
    }

    public function inactive(Schedule $schedule)
    {
        $schedule->status = 'inactive';
        $schedule->save();

        return redirect()->back()->with('success', 'Schedule has been marked as inactive.');
    }

    public function calendar(Request $request)
    {
        // Get the currently authenticated doctor
        $user = auth()->user();
        $doctor = Doctor::where('user_id', $user->id)->first();

        // Fetch upcoming appointments for the doctor
        $upcomingAppointments = Appointment::where('doctor_id', $doctor->id)
            ->where('date', '>=', now()) // Adjust the date comparison as needed
            ->orderBy('date', 'asc') // You can order by appointment date
            ->pluck('date')
            ->toArray();

        // Convert the DateTime objects to date strings
        $upcomingAppointments = array_map(function ($appointment) {
            return $appointment->format('Y-m-d'); // Adjust the date format as needed
        }, $upcomingAppointments);

        // Get unique date values
        $uniqueUpcomingAppointments = array_unique($upcomingAppointments);

        // Pass the data to the Blade view and return it
        return response()->view('doctor.schedule.calendar', ['upcomingAppointments' => $uniqueUpcomingAppointments]);
    }
    
}
