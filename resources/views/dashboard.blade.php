@vite('resources/css/app.css')
@include('nav')
<div class=" bg-slate-100 h-full flex justify-center items-center"><!-- Background div -->
@include('errors')


    <div class="bg-slate-300 w-full md:w-3/6 h-auto p-5 rounded-xl relative">

        <div class="flex justify-center">
            <button id="toggleCarsBtn" class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mb-5 rounded-lg">Load Cars</button><!--changed mt-5 to mb-5 -->
        </div>

        <div class="flex flex-wrap" id="carList" style="display: none;">
                @if ($cars)
                    @foreach ($cars as $car)
                        <div class="w-full md:w-1/2 lg:w-1/3 xl:w-1/4 p-2">
                            <div class="bg-white h-full rounded-lg shadow-md p-4">
                                <div class="h-3/6">
                                    <p><strong>Model:</strong> {{ $car->model }}</p>
                                    <p><strong>Manufacturer:</strong> {{ $car->manufacturer }}</p>
                                    <p><strong>Year:</strong> {{ $car->year }}</p>
                                    <p><strong>Fuel Type:</strong> {{ $car->fueltype }}</p>
                                </div>
                                <div class="h-3/6">
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
                        </div>
                    @endforeach
                @endif
            </div>


    </div>

</div>

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
