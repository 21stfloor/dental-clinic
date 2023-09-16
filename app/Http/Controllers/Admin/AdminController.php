<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Auth;

class AdminController extends Controller
{
    public function index(): Response
    {
        return response(view('admin.index'));
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
