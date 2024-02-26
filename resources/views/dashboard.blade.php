<h1>
    {{ 'Hello '.$name.'!' }}
</h1>
<h2>Cars:</h2>
<ul>
    @if ($cars)
        @foreach ($cars as $car)
            <li>

                <p>{{ $cars->model }}</p>
                <p>{{ $cars->manufacturer }}</p>
                <p>{{ $cars->year }}</p>
                {{ $cars->fueltype }}

            </li>
        @endforeach
    @endif
</ul>

@include('errors')






<a href="/logout" >Log out</a>
