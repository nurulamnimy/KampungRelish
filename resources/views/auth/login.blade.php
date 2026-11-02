@extends('layouts.app')
@section('title', 'Login')

@section('content')
<div class="form-box">
    <h2>Login</h2>
    <form method="POST" action="{{ route('login.attempt') }}" class="js-validate" novalidate>
        @csrf
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" data-rule="required|email" data-label="Email">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="pw" data-rule="required" data-label="Password">

        <label><input type="checkbox" class="toggle-password"> Show password</label>
        <br>
        <button type="submit" class="btn">Login</button>
        <p>No account yet? <a href="{{ route('register') }}">Sign up here</a></p>
        <p style="font-size:12px;color:#666">Demo admin: admin@kampungrelish.test / admin123<br>Demo user: aisyah@kampungrelish.test / user123</p>
    </form>
</div>
@endsection
