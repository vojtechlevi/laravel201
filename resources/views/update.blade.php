
<h1>Update the car data:</h1>
<form method="post" action="/edit"> <!-- Go via the Carcontroller to validate the new car -->
    @csrf
    <div class="form-group">
        <label for="id">The car have Id: {{ $car->id }}</label>
        <input type="hidden" name="id" value="{{ $car->id }}">
        <label for="model">Carmodel:</label>
        <input type="string" id="model" name="model" class="form-control" placeholder="{{ $car->model }}">
        <label for="manufacturer">Manufacterer:</label>
        <input type="string" id="manufacturer" name="manufacturer" class="form-control" placeholder="{{ $car->manufacturer }}">
        <label for="year">Year:</label>
        <input type="int" id="year" name="year" class="form-control" placeholder="{{ $car->year }}">
        <label for="fueltype">Fuel:</label>
        <input type="string" id="fueltype" name="fueltype" class="form-control" placeholder="{{ $car->fueltype }}">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
