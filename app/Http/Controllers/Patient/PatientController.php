<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use Illuminate\Http\Response;
use Auth;

class PatientController extends Controller
{
    public function index(): Response
    {
        return response(view('patient.index'));
    }

    public function profile(): Response
    {
        $patient = Auth::user();

        if (!Auth::check()) {
            return response()->json([ 'error' => 'UnAuthorized.'], 401);
        }

        $username = Auth::user()->username;
        $patientProfile = Patient::where('user_id', $patient->id)->first();

        return response(view('patient.profile', compact('patient', 'patientProfile')));
    }
}
