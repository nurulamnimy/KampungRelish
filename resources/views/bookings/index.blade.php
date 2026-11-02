@extends('layouts.app')
@section('title', 'Bookings')

@section('content')
    <h2>{{ auth()->user()->isAdmin() ? 'All Bookings' : 'My Bookings' }}</h2>

    <div class="filter-bar">
        <form method="GET" action="{{ route('bookings.index') }}" class="filter-bar" style="margin:0">
            <select name="status">
                <option value="">All status</option>
                @foreach(['pending', 'confirmed', 'cancelled'] as $s)
                    <option value="{{ $s }}" {{ request('status') == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
            <button class="btn" type="submit">Filter</button>
        </form>
        <input type="text" id="tableSearch" placeholder="Type to search in table...">
        <a class="btn btn-green" href="{{ route('bookings.create') }}">+ New Booking</a>
    </div>

    @if($bookings->isEmpty())
        <p>No bookings found.</p>
    @else
        <table class="searchable">
            <thead>
                <tr><th>ID</th>@if(auth()->user()->isAdmin())<th>User</th>@endif<th>Experience</th><th>Date</th><th>Pax</th><th>Total (RM)</th><th>Status</th><th>Action</th></tr>
            </thead>
            <tbody>
            @foreach($bookings as $b)
                <tr>
                    <td>{{ $b->id }}</td>
                    @if(auth()->user()->isAdmin())<td>{{ $b->user->name }}</td>@endif
                    <td>{{ $b->experience->name }}</td>
                    <td>{{ $b->booking_date }}</td>
                    <td>{{ $b->pax }}</td>
                    <td>{{ number_format($b->total_price, 2) }}</td>
                    <td><span class="badge {{ $b->status }}">{{ $b->status }}</span></td>
                    <td>
                        <a class="btn btn-sm" href="{{ route('bookings.edit', $b) }}">Edit</a>
                        <form action="{{ route('bookings.destroy', $b) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-red" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
