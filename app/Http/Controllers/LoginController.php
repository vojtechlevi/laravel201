<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        //$email = $request->only('email');
        //$password = $request->only('password');
        $credentials = $request->only('email', 'password');

        //if (Auth::attempt(['email' => $email, 'password' => $password])) {
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();


            return redirect()->intended('/dashboard');
        } else {
            echo 'Whoops! Something went wrong! Please try again';
            return redirect()->intended('/');
        }
    }
}
