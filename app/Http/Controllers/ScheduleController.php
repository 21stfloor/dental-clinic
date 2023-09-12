<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function getAvailableDoctors(Request $request)
    {
        $date = $request->input('date');
        $availableDoctors = Schedule::where('date', $date)
            ->where('available', true)
            ->get();

        return response()->json($availableDoctors);
    }
}
