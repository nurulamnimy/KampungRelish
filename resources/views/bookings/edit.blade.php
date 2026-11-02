@extends('layouts.app')
@section('title', 'Edit Booking')

@section('content')
<div class="form-box">
    <h2>Edit Booking (ID {{ $booking->id }})</h2>
    <form method="POST" action="{{ route('bookings.update', $booking) }}" class="js-validate" novalidate>
        @csrf
        @method('PUT')
        <label>Experience</label>
        <input type="text" value="{{ $booking->experience->name }}" disabled>

        <label for="booking_date">Date</label>
        <input type="date" id="booking_date" name="booking_date" value="{{ old('booking_date', $booking->booking_date) }}" data-rule="required" data-label="Date">

        <label for="pax">Number of People</label>
        <input type="number" id="pax" name="pax" min="1" max="20" value="{{ old('pax', $booking->pax) }}" data-rule="required" data-label="Number of people">

        @if(auth()->user()->isAdmin())
            <label for="status">Status</label>
            <select name="status" id="status">
                @foreach(['pending', 'confirmed', 'cancelled'] as $s)
                    <option value="{{ $s }}" {{ old('status', $booking->status) == $s ? 'selected' : '' }}>{{ ucfirst($s) }}</option>
                @endforeach
            </select>
        @endif
        <br>
        <button type="submit" class="btn">Update</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-grey">Cancel</a>
    </form>
</div>
@endsection
