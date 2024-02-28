@vite('resources/css/app.css')
<h1 class=" text-green-400">
    {{ 'Hello '.$name.'!' }}
</h1>
<button id="toggleCarsBtn" class="">Load Cars</button>

<h2>Cars:</h2>
<ul id="carList" style="display: none;">
    @if ($cars)
    @foreach ($cars as $car)
    <li>

        <p>{{ $car->model }}</p>
        <p>{{ $car->manufacturer }}</p>
        <p>{{ $car->year }}</p>
        {{ $car->fueltype }}

        <form action="/remove" method="post"><!--remove the car from the db -->
        @csrf <!-- CSRF protection -->
            <input type="hidden" name="id" value="{{ $car->id }}">
            <button type="submit" name="{{ $car->id }}" value="{{ $car->id }}">Remove Car</button>
        </form>

        <form action="/update" method="post">
        @csrf <!-- CSRF protection -->
        @method('post')
            <input type="hidden" name="id" value="{{ $car->id }}">
            <button type="submit" name="{{ $car->id }}">Change Car data</button>
        </form>

    </li>
    @endforeach
    @endif


</ul>

@include('errors')


<form method="post" action="{{ route('cars.store') }}"> <!-- Go via the Carcontroller to validate the new car -->
    @csrf
    <div class="form-group">
        <label for="model">Carmodel:</label>
        <input type="string" id="model" name="model" class="form-control">
        <label for="manufacturer">Manufacterer:</label>
        <input type="string" id="manufacturer" name="manufacturer" class="form-control">
        <label for="year">Year:</label>
        <input type="int" id="year" name="year" class="form-control">
        <label for="fueltype">Fuel:</label>
        <input type="string" id="fueltype" name="fueltype" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>





<a href="/logout">Log out</a>



<script>
    document.getElementById('toggleCarsBtn').addEventListener('click', function() {
        const carList = document.getElementById('carList');
        carList.classList.toggle('show');
    });
</script>

<style>
    .show {
        display: block !important;
    }
</style>
