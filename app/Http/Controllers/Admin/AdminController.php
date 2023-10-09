<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Http\Response;
use Auth;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function index(): Response
    {
        // Count the total number of users
        $totalUsers = User::count();

        // Count the number of recent logins for the current day
        $recentLogins = User::whereNotNull('last_login')
            ->whereDate('last_login', Carbon::today())
            ->count();

        // Count the total number of patients
        $totalPatients = Patient::count();

        // Count the total number of doctors
        $totalDoctors = Doctor::count();

        return response()->view('admin.index', compact(
            'totalUsers',
            'recentLogins',
            'totalPatients',
            'totalDoctors',
        ));
    }

    public function profile()
    {
        $admin = Auth::user();

        if (!Auth::check()) {
            return response()->json([ 'error' => 'UnAuthorized.'], 401);
        }

        $username = Auth::user()->username;

        return view('admin.profile', compact('admin'));
    }
}
