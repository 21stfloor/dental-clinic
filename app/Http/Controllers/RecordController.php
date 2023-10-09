<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Record;
use App\Http\Requests\StoreRecordRequest;
use App\Http\Requests\UpdateRecordRequest;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function myrecords()
    {
        $dt = app('datatables');
        $request = $dt->getRequest();
        
        if ($request->isXmlHttpRequest()) {
            $user = auth()->user();
            $patient = Patient::where('user_id', $user->id)->first();
            
            $records = Record::where('patient_id', $patient->id)
                ->join('doctors', 'records.doctor_id', '=', 'doctors.id')
                ->select('appointments.*', DB::raw("CONCAT('Dr. ', doctors.first_name, ' ', doctors.last_name) as doctor"))
                ->get();

            $result = DataTables::of($records)->toJson();

            return $result;
        }
        return response(view('patient.records.myrecords'));
    }


    public function records()
    {
        $dt = app('datatables');
        $request = $dt->getRequest();

        if ($request->isXmlHttpRequest()) {
            $user = auth()->user();
            $doctor = Doctor::where('user_id', $user->id)->first();

            $records = Record::where('doctor_id', $doctor->id)
                ->join('doctors', 'records.doctor_id', '=', 'doctors.id')
                ->join('patients', 'records.patient_id', '=', 'patients.id')
                ->select(
                    'records.*',
                    DB::raw("CONCAT('Dr. ', doctors.first_name, ' ', doctors.last_name) as doctor"),
                    DB::raw("CONCAT(patients.first_name, ' ', patients.last_name) as patient") // Concatenate patient's first_name and last_name
                )
                ->get();

            return DataTables::of($records)->toJson();
        }

        $patients = Patient::all(); // Retrieve all patients
        $serviceTypes = DB::table('services')->select(['title', 'availability'])->get();

        return view('doctor.records.records', compact('patients'))->with('serviceTypes', $serviceTypes);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'patient_id' => 'required|exists:patients,id',
            // Remove 'doctor_id' validation rule
            'image' => 'file',
            'date_completed' => 'required',
            'type' => 'required|string|max:255',
            'summary' => 'nullable|string',
        ]);

        $user = auth()->user();
        $doctor = Doctor::where('user_id', $user->id)->first();
        // Set the 'doctor_id' to the currently authenticated user's ID
        $validatedData['doctor_id'] = $doctor->id;

        // Handle image upload (if provided)
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('record_images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create a new record in the database
        Record::create($validatedData);

        // Redirect back with a success message or perform any other desired action
        $patients = Patient::all(); // Retrieve all patients
        // $doctors = Doctor::all(); // Retrieve all doctors

        $serviceTypes = DB::table('services')->select(['title', 'availability'])->get();

        return Redirect::route('doctors.records.records', compact(['patients', 'serviceTypes']));

        //return Redirect::route('doctor.records.records', compact(['patients, serviceTypes']));//->with('serviceTypes', $serviceTypes);
        // return view('doctor.records.records', compact('patients'))->with('serviceTypes', $serviceTypes);
    }

    public function deleteRecord($id)
    {
        // Find the record by ID
        $record = Record::find($id);

        // Check if the record exists
        if ($record) {
            // Delete the record
            $record->delete();

            // Return a response (e.g., JSON response, success message, or redirect)
            return response()->json(['message' => 'Record deleted successfully']);
        } else {
            // Handle the case where the record was not found (e.g., show an error message)
            return response()->json(['message' => 'Record not found'], 404);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRecordRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRecordRequest $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
