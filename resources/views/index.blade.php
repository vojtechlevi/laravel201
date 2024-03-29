@vite('resources/css/app.css')
@include('errors')

<div class=" bg-slate-100 h-full flex justify-center items-center">

    <div class="bg-slate-300 w-4/6 h-80 p-5 rounded-xl relative">
    @if (Session('error'))
            <div id="flash-message-error" class="text-red-500 text-3xl sm:text-4xl md:text-3xl lg:text-2xl">{{ Session('error') }}</div><!-- error msg's -->
        @endif
    @if (session('message'))
            <div id="flash-message-logout" class="text-green-500 alert alert-success text-3xl sm:text-4xl md:text-3xl lg:text-2xl">{{ session('message') }}</div><!-- user msg's -->
    @endif

        <form method="post" action="/login">
            @csrf
            <input class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl p-2 mt-2 rounded-lg w-full" name="email" id="email" type="email" placeholder="Email" />
            <input class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl p-2 mt-2 rounded-lg w-full" name="password" id="password" type="password" placeholder="Password" />
            <button class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl bg-blue-400 hover:bg-blue-600 text-white px-4 py-2 mt-5 rounded-lg" type="submit">Login</button>
        </form>




        <div class=" absolute bottom-5">
            <p class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl mt-3">Don't have an account?</p>
            <a class="text-3xl sm:text-4xl md:text-3xl lg:text-2xl underline" href="{{ route('register') }}">Register</a>
        </div>
    </div>
</div>
<script>// a timer to automaticly remove the log out message and the error messages
    document.addEventListener('DOMContentLoaded', function() {
        const logoutMsg = document.getElementById('flash-message-logout');
        const errorMsg = document.getElementById('flash-message-error');
        setTimeout(function() {
            if (logoutMsg || errorMsg) {
                logoutMsg.style.display = 'none';
                errorMsg.style.display = 'none';
            }
        }, 5000);
    });
</script>
