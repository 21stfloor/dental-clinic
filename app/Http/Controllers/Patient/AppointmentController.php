<?php

namespace App\Http\Controllers\Patient;

use App\Models\Patient;
use App\Models\Schedule;
use Carbon\CarbonInterval;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;


class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dt = app('datatables');
        $request = $dt->getRequest();
        if ($request->isXmlHttpRequest()) {
            $user = auth()->user();
            $patient = Patient::where('user_id', $user->id)->first();
            $appointments = Appointment::where('patient_id', $patient->id)
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->select('appointments.*', DB::raw("CONCAT('Dr. ', doctors.first_name, ' ', doctors.last_name) as doctor"))
                ->get();

            $result = DataTables::of($appointments)->toJson();
     
            return $result;
        }
        return response(view('patient.appointments.index'));
    }

    public function upcoming(Request $request)
    {
        $dt = app('datatables');
        $request = $dt->getRequest();
        
        if ($request->isXmlHttpRequest()) {
            $user = auth()->user();
            $patient = Patient::where('user_id', $user->id)->first();
            
            // Get only upcoming appointments (where the appointment date is in the future)
            $now = now();
            $appointments = Appointment::where('patient_id', $patient->id)
                ->join('doctors', 'appointments.doctor_id', '=', 'doctors.id')
                ->where('appointments.time', '>=', $now)
                ->select('appointments.*', DB::raw("CONCAT('Dr. ', doctors.first_name, ' ', doctors.last_name) as doctor"))
                ->get();

            $result = DataTables::of($appointments)->toJson();

            return $result;
        }
        
        return response(view('patient.upcoming'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Schedule $schedule): Response
    {
        // $serviceTypes = DB::table('services')->pluck(['title', 'availability']);
        $serviceTypes = DB::table('services')->select(['title', 'availability'])->get();

        return response(view('patient.appointments.create')->with('serviceTypes', $serviceTypes));
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
            'time' => 'required|unique:appointments,time,NULL,id,type,' . $request->input('type'),
            'type' => 'required|in:tooth-extraction,orthodontics,veneers,whitening-dental,filling',
            'notes' => 'nullable|max:1000',
        ]);

        if ($validator->fails()) {
            $scheduleId;
            return
                // redirect()->route('patients.appointments.create') 
                redirect("/patient/appointments/create")
                ->withErrors($validator)
                ->withInput();
        }

        Appointment::create([
            'schedule_id' => $request['schedule_id'],
            'doctor_id' => $request['doctor_id'],
            'patient_id' => auth()->user()->patient->id,
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
