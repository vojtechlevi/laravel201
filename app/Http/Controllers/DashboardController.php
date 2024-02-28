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

        // Get the name of the currently authenticated user from the database
        $name = $user->name;

        // Retrieve car models
        $carModels = Cars::all();

        



        return view('dashboard', ['name' => $name, 'cars' => $carModels]);
    }

}
