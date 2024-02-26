<h1>
    {{ 'Hello '.$name.'!' }}
</h1>
<h2>Cars:</h2>
<ul>
    @if ($cars)
        @foreach ($cars as $car)
            <li>

                <p>{{ $car->model }}</p>
                <p>{{ $car->manufacturer }}</p>
                <p>{{ $car->year }}</p>
                {{ $car->fueltype }}

            </li>
        @endforeach
    @endif
</ul>

@include('errors')






<a href="/logout" >Log out</a>
