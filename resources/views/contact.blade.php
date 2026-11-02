@extends('layouts.app')
@section('title', 'Contact')

@section('content')
<div class="form-box">
    <h2>Contact / Feedback</h2>
    <p>Got a question or a suggestion? Send us a message.</p>
    <form method="POST" action="{{ route('contact.send') }}" class="js-validate" novalidate>
        @csrf
        <label for="name">Your Name</label>
        <input type="text" id="name" name="name" value="{{ old('name') }}" data-rule="required" data-label="Name">

        <label for="email">Your Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" data-rule="required|email" data-label="Email">

        <label for="message">Message</label>
        <textarea id="message" name="message" rows="5" data-rule="required" data-label="Message">{{ old('message') }}</textarea>

        <br><button type="submit" class="btn">Send</button>
    </form>
</div>
@endsection
