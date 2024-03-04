<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        //get the data from the request form
        $credentials = $request->only('email', 'password');

        // if the data from the requestform match the credentials stored in the users table we generate a sessiontoken
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            //return redirect('dashboard');
            return redirect()->intended('/dashboard');//and send the now logged in user to the dashboard
        }
        else // if it didnt match any known user they get sent back to the login page with an error msg
        {

            Session::flash('error', 'Invalid email or password. Please try again.');

            return redirect()->intended('/');
        }
    }
}
