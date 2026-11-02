@extends('layouts.app')
@section('title', 'Home')

@section('hero')
<div class="hero">
    <h1>Taste Malaysia, One Kampung at a Time</h1>
    <p>Find street food walks, cooking classes and night market tours from local vendors, all in one place.</p>
    @guest
        <a href="{{ route('register') }}" class="btn">Join Now</a>
        <a href="{{ route('login') }}" class="btn btn-green">Login</a>
    @else
        <a href="{{ route('experiences.index') }}" class="btn">Browse Experiences</a>
    @endguest
</div>
@endsection

@section('content')
    <h2>Featured Experiences</h2>
    @if($featured->isEmpty())
        <p>No experiences yet.</p>
    @else
        <div class="cards">
            @foreach($featured as $exp)
                <div class="card">
                    <h3>{{ $exp->name }}</h3>
                    <p>{{ $exp->category }} | {{ $exp->location }}</p>
                    <p>{{ $exp->description }}</p>
                    <p class="price">RM {{ number_format($exp->price, 2) }}</p>
                    @auth
                        <a class="btn btn-sm" href="{{ route('experiences.show', $exp) }}">View</a>
                    @endauth
                </div>
            @endforeach
        </div>
    @endif

    <h2>Why KampungRelish?</h2>
    <div class="cards">
        <div class="card"><h3>All in one place</h3><p>No more searching through random posts. Every experience and vendor is listed here.</p></div>
        <div class="card"><h3>Easy to compare</h3><p>Search and sort by price, location or category to match your budget.</p></div>
        <div class="card"><h3>Real reviews</h3><p>Read ratings and comments from other tourists before you book.</p></div>
    </div>
@endsection
