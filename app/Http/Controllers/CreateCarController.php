<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;

class CreateCarController extends Controller
{
    public function __invoke(Request $request)
    {

        $this->validate($request, [
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'year' => 'required|integer',
            'fueltype' => 'required|string',
        ]);
        $userId = Auth::id();
        $model = $request->input('model'); //fetch the data from the request object
        $manufacturer = $request->input('manufacturer');
        $year = $request->input('year');
        $fueltype = $request->input('fueltype');



        $car = new Cars();//crate a new instance of the cars class and assign values from request object
        $car->model = $model;
        $car->manufacturer = $manufacturer;
        $car->year = $year;
        $car->fueltype = $fueltype;
        $car->userId = $userId; // tie to the users id. one user many cars, cars can only have 1 user realations

        $car->save();

        //redirect back to dahsboard
        return redirect('dashboard');


    }
}
