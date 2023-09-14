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
        if (Auth::user()->hasRole('admin')) {
            return redirect()->route('admins.dashboard');
        } elseif (Auth::user()->hasRole('patient')) {
            return redirect()->route('patients.dashboard');
        } elseif (Auth::user()->hasRole('doctor')) {
            return redirect()->route('doctors.dashboard');
        }
        abort(403, 'Unauthorized action.');
    }

}