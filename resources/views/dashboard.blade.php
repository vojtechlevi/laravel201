@vite('resources/css/app.css')
<nav class="bg-slate-300 py-4">
    <div class="max-w-7x1 mx-auto px-4">
        <div class="flex justify-between items-center">
            <div>
                <h1 class=" text-green-400">
                   {{'Welcome '.session('user_name').'!'}}
                </h1>
            </div>
            <div>
                <ul class="flex space-x-4">
                    <li><a href="/dashboard" class="text-white hover:text-gray-200">Your Cars</a></li>
                    <li><a href="/add" class="text-white hover:text-gray-200">Add Car</a></li>
                    <li><a href="/logout" class="text-white hover:text-gray-200">Log Out</a></li>
                </ul>
            </div>
        </div>
    </div>
</nav>
<div class=" bg-slate-100 h-full flex justify-center items-center"><!-- Background div -->
@include('errors')


    <div class="bg-slate-300 w-full md:w-3/6 h-auto p-5 rounded-xl relative">
        <!-- FLYTTAT TILL NAVBAR?
            <h1 class=" text-green-400">
            {{ 'Hello '.$name.'!' }}
        </h1> -->
        <div class="flex justify-center">
            <button id="toggleCarsBtn" class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mb-5 rounded-lg">Load Cars</button><!--changed mt-5 to mb-5 -->
        </div>

        <div class="flex flex-wrap" id="carList" style="display: none;">
           <!--  <h2>Cars:</h2>  WE DONT NEED THIS? REMOVE?-->
                @if ($cars)
                    @foreach ($cars as $car)
                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <div class="bg-white rounded-lg shadow-md p-4">
                                <p><strong>Model:</strong> {{ $car->model }}</p>
                                <p><strong>Manufacturer:</strong> {{ $car->manufacturer }}</p>
                                <p><strong>Year:</strong> {{ $car->year }}</p>
                                <p><strong>Fuel Type:</strong> {{ $car->fueltype }}</p>

                                <!--updata cardata in the db -->
                                <form action="/update" method="post">
                                    @csrf <!-- CSRF protection -->
                                    @method('post')
                                    <input type="hidden" name="id" value="{{ $car->id }}">
                                    <button type="submit" name="{{ $car->id }}" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Change Car data</button>
                                </form>

                                <!--remove the car from the db -->
                                <form action="/remove" method="post">
                                    @csrf <!-- CSRF protection -->
                                    <input type="hidden" name="id" value="{{ $car->id }}">
                                    <button type="submit" name="{{ $car->id }}" value="{{ $car->id }}" class="mt-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Remove Car</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>



<!-- FLYTTAT TILL EGEN PAGE?

        <form method="post" action="{{ route('cars.store') }}">
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
            <button type="submit" class="bg-blue-400 text-white px-4 py-2 mt-5 rounded-lg btn btn-primary">Submit</button>
        </form>
-->

    </div>

</div>
<!-- FLYTTAT TILL NAVBAR?
<div class=" absolute bottom-5">
    <a href="/logout">
    <button class="bg-blue-400 text-white px-4 py-2 mt-5 rounded-lg btn btn-primary">Log out</button>
    </a>
</div> -->
<script>
    let showCarBtn = document.getElementById('toggleCarsBtn');
    showCarBtn.addEventListener('click', function() {
        const carList = document.getElementById('carList');
        carList.classList.toggle('show');
        if(carList.classList.contains('show')){
            showCarBtn.innerText = "Hide Cars";
        }else{
            showCarBtn.innerText = "Load Cars";
        }
    });
</script>

<style>
    .show {
        display: flex !important;
    }
</style>
