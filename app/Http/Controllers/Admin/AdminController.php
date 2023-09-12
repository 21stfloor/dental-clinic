<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    public function index(): Response
    {
        return response(view('admin.index'));
    }

    public function profile()
    {
        $user = auth()->user();

        return view('admin.profile', compact('user'));
    }
}
