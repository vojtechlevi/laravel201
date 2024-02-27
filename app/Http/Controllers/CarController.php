<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return view('index', compact('cars'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $car = Car::create($request->all());
        return redirect()->route('cars.index');
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }

    public function edit(Car $car)
    {
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $car->update($request->all());
        return redirect()->route('cars.index');
    }

    public function destroy(Car $car)
    {
        $car->delete();
        return redirect()->route('cars.index');
    }
}
