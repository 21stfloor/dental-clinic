<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class PatientController extends Controller
{
    public function index(): Response
    {
        return response(view('patient.index'));
    }

    public function profile(): Response
    {
        return response(view('patient.profile'));
    }
}
