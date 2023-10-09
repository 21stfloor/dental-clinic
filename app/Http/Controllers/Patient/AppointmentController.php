<?php

namespace App\Http\Controllers\Patient;

use App\Models\Doctor;
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
                ->where('appointments.date', '>=', $now)
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
            'date' => 'required|unique:appointments,date,NULL,id,type,' . $request->input('type'),
            'type' => 'required',
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
            'date' => $request['date'],
            'type' => $request['type'],
            'notes' => $request['notes'],
            'status' => 'pending',
        ]);

        return redirect()->route('patients.appointments.index')->with('success', 'Appointment created successfully.');
    }
    
    public function cancel($id)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        // Check if the appointment exists
        if ($appointment) {
            // Set the appointment status to "Cancelled"
            $appointment->status = 'Cancelled';
            $appointment->save();

            // Return a response (e.g., JSON response, success message, or redirect)
            return response()->json(['message' => 'Appointment cancelled successfully']);
        } else {
            // Handle the case where the appointment was not found (e.g., show an error message)
            return response()->json(['message' => 'Appointment not found'], 404);
        }
    }
    public function doctorAppointments(Request $request)
    {
        $dt = app('datatables');
        $request = $dt->getRequest();
        $user = auth()->user();
        $doctor = Doctor::where('user_id', $user->id)->first();

        if ($request->isXmlHttpRequest()) {
            
            $appointments = Appointment::where('doctor_id', $doctor->id)
                ->join('patients', 'appointments.patient_id', '=', 'patients.id')
                ->select('appointments.*', DB::raw("CONCAT(patients.first_name, ' ', patients.last_name) as patient"), "patients.contact_number")
                ->get();

            $result = DataTables::of($appointments)->toJson();
     
            return $result;
        }
        return response(view('doctor.appointments.doctor'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the appointment by ID
        $appointment = Appointment::find($id);

        // Check if the appointment exists
        if (!$appointment) {
            return response()->json(['message' => 'Appointment not found'], 404);
        }

        // Get the new status from the request
        $newStatus = $request->input('status');
        $notes = $request->input('notes');

        // Update the appointment status
        $appointment->status = $newStatus;
        $appointment->notes = $notes;
        $appointment->save();

        return response()->json(['message' => 'Appointment status updated successfully']);
    }
}
