<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'KampungRelish') | KampungRelish</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

{{-- HEADER + NAVIGATION --}}
<header>
    <a href="{{ route('home') }}" class="brand">Kampung<span>Relish</span>
        <small>Local Food &amp; Tourism Experiences</small>
    </a>
    <nav>
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        @auth
            <a href="{{ route('experiences.index') }}" class="{{ request()->routeIs('experiences.*') ? 'active' : '' }}">Experiences</a>
            <a href="{{ route('bookings.index') }}" class="{{ request()->routeIs('bookings.*') ? 'active' : '' }}">Bookings</a>
            @if(auth()->user()->isAdmin())
                <a href="{{ route('vendors.index') }}" class="{{ request()->routeIs('vendors.*') ? 'active' : '' }}">Vendors</a>
                <a href="{{ route('reviews.index') }}" class="{{ request()->routeIs('reviews.index') ? 'active' : '' }}">Reviews</a>
            @endif
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
        @endauth
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
        @guest
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}">Sign Up</a>
        @else
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout ({{ auth()->user()->name }})</button>
            </form>
        @endguest
    </nav>
</header>

@yield('hero')

{{-- MAIN CONTENT --}}
<main>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>

{{-- FOOTER --}}
<footer>
    <p>&copy; {{ date('Y') }} KampungRelish. CSC1413 Web Programming Final Project.</p>
    <p>Made by Nurul Amni | Kolej Profesional MARA Beranang | <a href="{{ route('contact') }}">Contact us</a></p>
</footer>

<script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
