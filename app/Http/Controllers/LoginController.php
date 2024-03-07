<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function __invoke(Request $request)
    {
        // Validate the data, check if the required fields are present and if they are correct format
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('login')
                ->withErrors($validator)
                ->withInput();
        }


        //get the data from the request form IF validation succeses
        $credentials = $request->only('email', 'password');

        // if the data from the requestform match the credentials stored in the users table we generate a sessiontoken
        if(Auth::attempt($credentials)){
            $request->session()->regenerate();

            return redirect('dashboard');
        }
        else // if it didnt match any known user they get sent back to the login page with an error msg
        {
            /*TODO ERROR MESG DOESNT GET SHOWN TO USER ON FAILED LOGIN */
            //Session::flash('error', 'Invalid email or password. Please try again.');

            return redirect()->route('login')->with('error', 'Invalid email or password. Please try again.');
        }
    }
}
