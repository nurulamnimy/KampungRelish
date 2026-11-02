@extends('layouts.app')
@section('title', 'Dashboard')

@section('content')
    <h2>Hello, {{ $user->name }} ({{ ucfirst($user->role) }})</h2>

    @if($user->isAdmin())
        <div class="cards">
            <div class="card"><div class="stat">{{ $stats['experiences'] }}</div>Food Experiences</div>
            <div class="card"><div class="stat">{{ $stats['vendors'] }}</div>Vendors</div>
            <div class="card"><div class="stat">{{ $stats['reviews'] }}</div>Reviews</div>
            <div class="card"><div class="stat">{{ $stats['bookings'] }}</div>Bookings</div>
            <div class="card"><div class="stat">{{ $stats['users'] }}</div>Registered Users</div>
        </div>
        <a class="btn" href="{{ route('experiences.create') }}">+ Add Experience</a>
        <a class="btn btn-green" href="{{ route('vendors.create') }}">+ Add Vendor</a>
    @else
        <h3>My Latest Bookings</h3>
        @if($myBookings->isEmpty())
            <p>You have no bookings yet. <a href="{{ route('experiences.index') }}">Find an experience</a>.</p>
        @else
            <table>
                <thead><tr><th>Experience</th><th>Date</th><th>Pax</th><th>Total</th><th>Status</th></tr></thead>
                <tbody>
                @foreach($myBookings as $b)
                    <tr>
                        <td>{{ $b->experience->name }}</td>
                        <td>{{ $b->booking_date }}</td>
                        <td>{{ $b->pax }}</td>
                        <td>RM {{ number_format($b->total_price, 2) }}</td>
                        <td><span class="badge {{ $b->status }}">{{ $b->status }}</span></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
        <p><a class="btn" href="{{ route('bookings.create') }}">+ New Booking</a></p>
    @endif
@endsection
