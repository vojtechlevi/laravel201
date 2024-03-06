<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cars;

class DashboardController extends Controller
{
    public function __invoke()
    {
        // Get the currently authenticated user
        $user = Auth::user();
        //store the user in a sessionvariable
        session(['user_name' => Auth::user()->name]);
        session(['user' => $user]);
        // Get the name of the currently authenticated user from the database
        $name = $user->name;

        // Retrieve car models
        //$carModels = Cars::all();//remove, this loads all cars even if the logged in user doesnt have any cars
        $carModels = Cars::where('userId', Auth::id())->get(); //try to only load the cars of the logged in user





        return view('dashboard', ['name' => $name, 'cars' => $carModels]);
    }

}
