<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    function index() {
        $available_services = Service::where('availability', 1)->get();
        
        return view('pages.services', ['services' => $available_services]);
    }
}
