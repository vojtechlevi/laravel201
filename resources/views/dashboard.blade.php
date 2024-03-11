<body class="bg-slate-100 flex flex-col">
@vite('resources/css/app.css')
@include('nav')
<div class="flex-1 flex justify-center items-center"><!-- Background div -->
@include('errors')


    <div class="bg-slate-300 w-full md:w-3/6 min-h-screen md:min-h-0 overflow-y-auto p-5 rounded-xl relative mt-20">
    @include('succes')
        <div class="flex justify-center">
            <button id="toggleCarsBtn" class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mb-5 rounded-lg">Load Cars</button><!--changed mt-5 to mb-5 -->
        </div>

        <div class="flex flex-wrap" id="carList" style="display: none;">
                @if ($cars)
                    @foreach ($cars as $car)
                        <div class="w-1/2 p-2">
                            <div class="bg-white w-full h-full rounded-lg shadow-md p-4">
                                <div class="h-3/6"><!-- take half the available space always-->
                                    <p class="text-2xl sm:text-3xl md:text-2xl lg:text-xl"><strong>Model:</strong> {{ $car->model }}</p>
                                    <p class="text-2xl sm:text-3xl md:text-2xl lg:text-xl"><strong>Manufacturer:</strong> {{ $car->manufacturer }}</p>
                                    <p class="text-2xl sm:text-3xl md:text-2xl lg:text-xl"><strong>Year:</strong> {{ $car->year }}</p>
                                    <p class="text-2xl sm:text-3xl md:text-2xl lg:text-xl"><strong>Fuel Type:</strong> {{ $car->fueltype }}</p>
                                </div>
                                <div class="h-3/6"><!-- the rest of the space for the buttons -->
                                    <!--updata cardata in the db -->
                                    <form action="/update" method="post">
                                        @csrf <!-- CSRF protection -->
                                        @method('post')
                                        <input type="hidden" name="id" value="{{ $car->id }}">
                                        <button type="submit" name="{{ $car->id }}" class="text-2xl sm:text-3xl md:text-2xl lg:text-xl mt-4 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-md">Update Car</button>
                                    </form>

                                    <!--remove the car from the db -->
                                    <form action="/remove" method="post">
                                        @csrf <!-- CSRF protection -->
                                        <input type="hidden" name="id" value="{{ $car->id }}">
                                        <button type="submit" name="{{ $car->id }}" value="{{ $car->id }}" class="text-2xl sm:text-3xl md:text-2xl lg:text-xl mt-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Remove Car</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>


    </div>

</div>

<script>
    let showCarBtn = document.getElementById('toggleCarsBtn');//get the load cars button
    showCarBtn.addEventListener('click', function() {//when the user clicks the button
        const carList = document.getElementById('carList');//show the users cars
        carList.classList.toggle('show');//by toggling the show class
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
