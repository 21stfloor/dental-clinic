<?php

namespace App\Http\Controllers\Doctor;

use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

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
    public function store()
    {
        $validatedData = request()->validate([
            'date' => 'required|date',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        Auth::user()->doctor->schedules()->create([
            'date' => $validatedData['date'],
            'day' => Carbon::parse($validatedData['date'])->format('l'),
            'start_time' => $validatedData['start_time'],
            'end_time' => $validatedData['end_time'],
            'status' => 'active',
        ]);

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
}
