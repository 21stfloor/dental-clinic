<?php

namespace App\Http\Controllers\Patient;

use App\Models\Schedule;
use Carbon\CarbonInterval;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Validator;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Schedule $schedule): Response
    {
        $schedules = Schedule::where('status', 'active')->get();

        return response(view('patient.appointments.index', compact('schedules')));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Schedule $schedule): Response
    {
        $availableTimeSlots = [];

        $start = Carbon::parse($schedule->start_time);
        $end = Carbon::parse($schedule->end_time);
        $interval = CarbonInterval::minutes(60);
        $slots = [];
        for ($slot = $start; $slot->lte($end); $slot->add($interval)) {
            $slots[] = $slot->format('H:i:s');
        }
        $availableTimeSlots[$schedule->id] = $slots;

        return response(view('patient.appointments.create', compact('schedule', 'availableTimeSlots')));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $scheduleId = $request['schedule_id'];

        $validator = Validator::make($request->all(), [
            'schedule_id' => 'required|exists:schedules,id',
            'doctor_id' => 'required|exists:doctors,id',
            'title' => 'required|max:255',
            'time' => 'required|unique:appointments,time,NULL,id,type,' . $request->input('type'),
            'type' => 'required|in:tooth-extraction,orthodontics,veneers,whitening-dental,filling',
            'notes' => 'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            $scheduleId;
            return redirect("/patient/appointments/{$scheduleId}")
                ->withErrors($validator)
                ->withInput();
        }

        Appointment::create([
            'schedule_id' => $request['schedule_id'],
            'doctor_id' => $request['doctor_id'],
            'patient_id' => auth()->user()->patient->id,
            'title' => $request['title'],
            'time' => $request['time'],
            'type' => $request['type'],
            'notes' => $request['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('patients.appointments.index')->with('success', 'Appointment created successfully.');
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
    public function update(Request $request, string $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        //
    }
}
