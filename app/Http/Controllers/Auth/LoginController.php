<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        try {
            $fields = $request->validate([
                "username" => "required|string",
                "password" => "required|string"
            ]);

            $user = User::where("username", $fields["username"])->first();

            if (!$user || !Hash::check($fields["password"], $user->password)) {
                return response([
                    "message" => "Unauthorized",
                ], 401);
            }

            $token = $user->createToken("myapitoken")->plainTextToken;

     
            if (Auth::attempt($fields)) {
                $request->session()->regenerate();
     
                return redirect()->intended('dashboard');
            }
     
            return back()->withErrors([
                'username' => 'The provided credentials do not match our records.',
            ])->onlyInput('username');

        } catch (\Exception $e) {
            return response([
                "message" => "An error occurred.",
                "error" => $e->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }
}
