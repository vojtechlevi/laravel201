<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


/* class RemoveCarController extends Controller
{

    public function Remove(Request $request)
    {
        $car = Cars::find($request->input('id'));

        $car->delete();

        return redirect()->route('some.route')->with('success', 'Car removed successfully.');

<?php
 */

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

            // Reset the auto-increment value for the ID col to whatever id we removed
            DB::statement("ALTER TABLE cars AUTO_INCREMENT = $carId");
            //DB::statement("ALTER TABLE cars AUTO_INCREMENT = 1");
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
