<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogOutController extends Controller
{
    public function __invoke()
    {
        Auth::logout();//logs the user out
        return redirect('/');//redirects to the index, its where the user log in from the :
                                                        /* Route::get('/',  function () {
                                                    return view('index');
                                                });

        */
    }
}
