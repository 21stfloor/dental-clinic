<?php

namespace App\Http\Controllers\Doctor;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Models\Schedule;

class DoctorController extends Controller
{
    public function index(): Response
    {
        return response(view('doctor.index'));
    }

    public function profile(): Response
    {
        return response(view('doctor.profile'));
    }
}
