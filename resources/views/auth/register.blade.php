@extends('layouts.app')
@section('title', 'Sign Up')

@section('content')
<div class="form-box">
    <h2>Create Account</h2>
    <form method="POST" action="{{ route('register.store') }}" class="js-validate" novalidate>
        @csrf
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" data-rule="required" data-label="Name">

        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" data-rule="required|email" data-label="Email">

        <label for="phone">Phone Number</label>
        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" data-rule="required|digits" data-label="Phone number">

        <label for="password">Password</label>
        <input type="password" id="password" name="password" class="pw" data-rule="required|min6" data-label="Password">

        <label for="password_confirmation">Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="pw" data-rule="required|match" data-match="password" data-label="Confirm password">

        <label><input type="checkbox" class="toggle-password"> Show password</label>
        <br>
        <button type="submit" class="btn">Sign Up</button>
        <p>Already have an account? <a href="{{ route('login') }}">Login here</a></p>
    </form>
</div>
@endsection
