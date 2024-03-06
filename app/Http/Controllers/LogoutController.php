<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();//logs the user out
        return redirect('/')->with('message', 'Goodbye!');//redirects to the index
    }
}
