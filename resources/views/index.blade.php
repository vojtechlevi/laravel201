@vite('resources/css/app.css')
<div class=" bg-slate-100 h-full flex justify-center items-center">
    <div class="bg-slate-300 w-3/6 h-72 p-5 rounded-xl relative">
        <form method="post" action="/login">
            @csrf
            <input class=" p-2 mt-2 rounded-lg w-full" name="email" id="email" type="email" placeholder="Email" />
            <input class=" p-2 mt-2 rounded-lg w-full" name="password" id="password" type="password" placeholder="Password" />
            <button class=" bg-blue-400 text-white px-4 py-2 mt-5 rounded-lg" type="submit">Login</button>
        </form>

        @include('errors')<!-- Om vi får error visas de här -->

        <!-- Add a " Register" button -->
        <div class=" absolute bottom-5">
            <p class="text-sm">Don't have an account?</p>
            <a class="underline" href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>