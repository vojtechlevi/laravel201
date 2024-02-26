<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    public function __invoke(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (Auth::attempt(['email' => $email, 'password' => $password])) {
            $request->session()->regenerate();

            return redirect()->intended('/dashboard');
        } else {
            echo 'Whoops! Please try to login again.';
            return redirect()->intended('welcome');
        }
    }
}
