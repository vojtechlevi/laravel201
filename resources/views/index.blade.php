<form method="post" action="/login">

    @csrf
    <div>
        <label for="email">Email</label>
        <input name="email" id="email" type="email" />
    </div>
    <div>
        <label for="password">Password</label>
        <input name="password" id="password" type="password" />
    </div>
    <button type="submit">Login</button>
</form>

<!-- Add a "Register" button -->
<div>
    <p>Don't have an account?</p>
    <a href="{{ route('register') }}">Register</a>
</div>
