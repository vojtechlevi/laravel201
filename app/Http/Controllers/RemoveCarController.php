<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;



class RemoveCarController extends Controller
{

    public function Remove(Request $request)
    {
        $user = Auth::user();
        //get the car from the database via the car id
        $carId = $request->input('id');
        $car = Cars::find($carId);


        $name = $user->name;
        // Retrieve car models
        $carModels = Cars::all();

        if ($car) { //if the car exists in the database, then remove it
            $car->delete();

            if($carModels){
                return redirect('dashboard')->with(['success' => 'Car removed successfully.', 'name' => $name, 'cars' => $carModels]);
            }
            else{
                return redirect('dashboard', ['name' => $name,]);
            }
        } else {
            return redirect('dashboard')->with(['error' => 'Car not found.', 'name' => $name, 'cars' => $carModels]);// if the car id didnt exist in db, return to db with failmsg
        }

    }
}
