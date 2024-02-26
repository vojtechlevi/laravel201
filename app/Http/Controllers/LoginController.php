<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Redirect authenticated users to the dashboard
            return redirect()->intended('/dashboard');
        } else {
            return redirect()->back()->with('error', 'Invalid credentials.');
        }
    }
}
