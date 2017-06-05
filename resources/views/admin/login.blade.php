<form method="POST" action='/admin/login'>
    {!! csrf_field() !!}

    <div>
        name
        <input type="email" name="name" value="{{ old('name') }}">
    </div>

    <div>
        Password
        <input type="password" name="password" id="password">
    </div>

    <div>
        <input type="checkbox" name="remember"> Remember Me
    </div>

    <div>
        <button type="submit">Login</button>
    </div>
</form>