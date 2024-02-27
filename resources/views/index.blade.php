@foreach ($cars as $car)
<p>{{ $car->make }} {{ $car->model }} {{ $car->fuel_type }} {{ $car->year }} {{ $car->color }}</p>
@endforeach

<button><a href="{{ route('cars.create') }}">Add new car</a></button>