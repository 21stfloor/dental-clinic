<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return RedirectResponse
     */
    // app/Http/Controllers/HomeController.php

    public function index()
    {
        $rolePatient = Role::where('name', 'patient')->first();
        $roleAdmin = Role::where('name', 'admin')->first();
        $roleDoctor = Role::where('name', 'doctor')->first();

        $roles = Auth::user()->roles;

        echo ''.$roles;

        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admins.dashboard');
        } elseif (Auth::user()->hasRole('patient')) {
            return redirect()->route('patients.dashboard');
        } elseif (Auth::user()->hasRole('doctor')) {
            return redirect()->route('doctors.dashboard');
        }

        if (Auth::check()) {
            echo "The user is logged in...";
            // The user is logged in...
        }

        abort(403, 'Unauthorized action.');
    }

}
