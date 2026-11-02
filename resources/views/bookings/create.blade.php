@extends('layouts.app')
@section('title', 'New Booking')

@section('content')
<div class="form-box">
    <h2>Book an Experience</h2>
    <form method="POST" action="{{ route('bookings.store') }}" class="js-validate" novalidate>
        @csrf
        <label for="experience_id">Experience</label>
        <select name="experience_id" id="experience_id" data-rule="required" data-label="Experience">
            <option value="">-- choose experience --</option>
            @foreach($experiences as $exp)
                <option value="{{ $exp->id }}" data-price="{{ $exp->price }}"
                    {{ old('experience_id', $selected) == $exp->id ? 'selected' : '' }}>
                    {{ $exp->name }} (RM {{ number_format($exp->price, 2) }})
                </option>
            @endforeach
        </select>

        <label for="booking_date">Date</label>
        <input type="date" id="booking_date" name="booking_date" min="{{ date('Y-m-d') }}" value="{{ old('booking_date') }}" data-rule="required" data-label="Date">

        <label for="pax">Number of People</label>
        <input type="number" id="pax" name="pax" min="1" max="20" value="{{ old('pax', 1) }}" data-rule="required" data-label="Number of people">

        <p><strong>Total: <span id="totalPrice">RM 0.00</span></strong></p>
        <button type="submit" class="btn">Confirm Booking</button>
        <a href="{{ route('bookings.index') }}" class="btn btn-grey">Cancel</a>
    </form>
</div>
@endsection
