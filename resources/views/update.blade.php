@vite('resources/css/app.css')
@include('nav')
<div class=" bg-slate-100 h-full flex justify-center items-center"><!-- Background div -->
@include('errors')

<div class="bg-slate-300 w-full md:w-3/6 h-auto p-5 rounded-xl relative">

        <h1 class="text-3x1 font-bold text-center text-gray-900 mt-8 mb-4">Update the car details of your {{$car->model}}</h1>
        <form method="post" action="/edit">
            @csrf
            <div class="form-group">

                <input type="hidden" name="id" value="{{ $car->id }}">
                <label for="model">Carmodel:</label>
                <input type="string" id="model" name="model" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="{{ $car->model }}">
                <label for="manufacturer">Manufacterer:</label>
                <input type="string" id="manufacturer" name="manufacturer" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="{{ $car->manufacturer }}">
                <label for="year">Year:</label>
                <input type="int" id="year" name="year" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="{{ $car->year }}">
                <label for="fueltype">Fuel:</label>
                <input type="string" id="fueltype" name="fueltype" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="{{ $car->fueltype }}">
            </div>
            <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 mb-5 rounded-lg btn btn-primary">Submit</button>

        </form>
