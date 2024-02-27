<form method="POST" action="{{ route('cars.store') }}">
    @csrf
    <label for="make">Make:</label>
    <input type="text" id="make" name="make">

    <label for="fuel_type">Fuel Type:</label>
    <input type="text" id="fuel_type" name="fuel_type">

    <label for="model">Model:</label>
    <input type="text" id="model" name="model">

    <label for="year">Year:</label>
    <input type="text" id="year" name="year">

    <label for="color">Color:</label>
    <input type="text" id="color" name="color">
    <!-- Add other fields here -->
    <button type="submit">Create</button>
</form>