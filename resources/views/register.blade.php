@vite('resources/css/app.css')
<div class=" bg-slate-100 h-full flex justify-center items-center">
    <div class="bg-slate-300 w-3/6 h-96 p-5 rounded-xl relative">
        <form method="post" action="{{ route('register') }}">
            @csrf

            @include('errors')
            <input class=" p-2 mt-2 rounded-lg w-full" type="text" name="name" placeholder="Name">
            <input class=" p-2 mt-5 rounded-lg w-full" type="email" name="email" placeholder="Email">
            <input class=" p-2 mt-5 rounded-lg w-full" type="password" name="password" placeholder="Password">
            <input class=" p-2 mt-5 rounded-lg w-full" type="password" name="password_confirmation" placeholder="Confirm Password">

            <button class=" bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 rounded-lg" type="submit">Register</button>

        </form>
        <a href="/" class="text-white px-4 mt-5 hover:text-blue-600"><--Go back</a>
    </div>
</div>
