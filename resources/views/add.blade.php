@vite('resources/css/app.css')
@include('nav')
<div class=" bg-slate-100 h-full flex justify-center items-center"><!-- Background div -->
@include('errors')
@include('succes')
<div class="bg-slate-300 w-full md:w-3/6 h-auto p-5 rounded-xl relative">
    <form method="post" action="{{ route('cars.store') }}"> <!-- Go via the Carcontroller to validate the new car -->
    @csrf
        <div class="form-group">
            <label for="model">Carmodel:</label>
            <input type="string" id="model" name="model" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="ex: Model X">
            <label for="manufacturer">Manufacterer:</label>
            <input type="string" id="manufacturer" name="manufacturer" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="ex: Tesla">
            <label for="year">Year:</label>
            <input type="int" id="year" name="year" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="ex: 2020">
            <label for="fueltype">Fuel:</label>
            <input type="string" id="fueltype" name="fueltype" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="ex: Electric">
        </div>
        <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 rounded-lg btn btn-primary">Submit</button>
    </form>
</div>
