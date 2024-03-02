@vite('resources/css/app.css')
@include('errors')<!-- login errors are shown here -->

<div class=" bg-slate-100 h-full flex justify-center items-center">

    <div class="bg-slate-300 w-3/6 h-72 p-5 rounded-xl relative">
    @if (Session::has('error'))
            <div class="text-red-500">{{ Session::get('error') }}</div>
        @endif
        
        <form method="post" action="/login">
            @csrf
            <input class=" p-2 mt-2 rounded-lg w-full" name="email" id="email" type="email" placeholder="Email" />
            <input class=" p-2 mt-2 rounded-lg w-full" name="password" id="password" type="password" placeholder="Password" />
            <button class=" bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 rounded-lg" type="submit">Login</button>
        </form>




        <div class=" absolute bottom-5">
            <p class="text-sm">Don't have an account?</p>
            <a class="underline" href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>
