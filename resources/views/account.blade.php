@vite('resources/css/app.css')
@include('nav')
<div class="flex flex-col bg-slate-100 h-full flex justify-center items-center"><!-- Background div -->
@include('errors')
@include('succes')

    <div class="bg-slate-300 w-full md:w-3/6 h-auto p-5 rounded-xl relative">

        <h1 class="text-3x1 font-bold text-center text-gray-900 mt-8 mb-4">Update the details of your account</h1>
        <form method="post" action="/account">
            @csrf
            <div class="form-group">

                <input type="hidden" name="id" value="{{ $user->id }}">
                <label for="name">Name:</label>
                <input type="string" id="name" name="name" class="form-control p-2 mt-2 mb-2 rounded-lg w-full" placeholder="{{ $user->name }}">
                <label for="manufacturer">E-mail:</label>
                <input type="email" id="email" name="email" class="form-control p-2 mt-2 mb-2 rounded-lg w-full" placeholder="{{ $user->email }}">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control p-2 mt-2 rounded-lg w-full" placeholder="Your new top secret password">
                <input class=" p-2 mt-5 rounded-lg w-full" type="password" name="password_confirmation" placeholder="Confirm the new password">
            </div>

            <button type="submit" class="bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 mb-5 rounded-lg btn btn-primary">Submit</button>

        </form>
        <form action="/removeAccount" method="post">
                @csrf <!-- CSRF protection -->
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" name="{{ $user->id }}" value="{{ $user->id }}" class="mt-2 bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md">Remove Account</button>
            </form>
    </div>



</div>
