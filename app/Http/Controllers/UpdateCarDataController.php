<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;

class UpdateCarDataController extends Controller
{

     public function Update(Request $request)
    {
        $user = Auth::user();

         //get the car from the database via the car id
         $car = Cars::find($request->input('id'));

        if ($car)
        {
            return view('update')->with(['user' => $user, 'car' => $car]); //redirect to the update page
        }
        else
        {
            return redirect('dashboard')->with('The car id couldnt be found in the database'); // or return to dashboard with errormsg
        }
    }

    public function Edit(Request $request)
    {
        $this->validate($request, [
            'model' => 'required|string',
            'manufacturer' => 'required|string',
            'year' => 'required|integer',
            'fueltype' => 'required|string',
        ]);
        $car = Cars::find($request->input('id'));
        $userId = Auth::id();
        $carId = $request->input('id');
        $model = $request->input('model'); //fetch the data from the request object
        $manufacturer = $request->input('manufacturer');
        $year = $request->input('year');
        $fueltype = $request->input('fueltype');
        $user = Auth::user();
        $car->id = $carId;
        $car->model = $model;
        $car->manufacturer = $manufacturer;
        $car->year = $year;
        $car->fueltype = $fueltype;
        $car->userId = $userId; // tie to the users id. one user many cars, cars can only have 1 user realations

        $car->save();

        $name = $user->name;
        // Retrieve car models
        $carModels = Cars::all();

        //redirect back to dahsboard
        return redirect('dashboard')->with(['success' => 'Car removed successfully.', 'name' => $name, 'cars' => $carModels]);
    }
}
