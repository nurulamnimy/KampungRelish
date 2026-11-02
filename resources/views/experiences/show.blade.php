@extends('layouts.app')
@section('title', $experience->name)

@section('content')
    <h2>{{ $experience->name }}</h2>
    <div class="card">
        <p><strong>Vendor:</strong> {{ $experience->vendor->name }} ({{ $experience->vendor->phone }})</p>
        <p><strong>Location:</strong> {{ $experience->location }}</p>
        <p><strong>Category:</strong> {{ $experience->category }}</p>
        <p><strong>Description:</strong> {{ $experience->description }}</p>
        <p><strong>Menu:</strong> {{ $experience->menu ?? '-' }}</p>
        <p class="price">RM {{ number_format($experience->price, 2) }} / person</p>
        @if($experience->status === 'active')
            <a class="btn" href="{{ route('bookings.create', ['experience_id' => $experience->id]) }}">Book Now</a>
        @else
            <span class="badge inactive">Not available</span>
        @endif
        <a class="btn btn-green" href="{{ route('reviews.create', $experience) }}">Write a Review</a>
        <a class="btn btn-grey" href="{{ route('experiences.index') }}">Back</a>
    </div>

    <h3>Reviews ({{ $experience->reviews->count() }})
        <button type="button" id="toggleReviews" class="btn btn-sm btn-grey">Hide Reviews</button>
    </h3>
    <div id="reviewBox">
        @forelse($experience->reviews as $review)
            <div class="card" style="margin-bottom:10px">
                <strong>{{ $review->user->name }}</strong>
                <span class="stars">
                    @for($i = 1; $i <= 5; $i++){{ $i <= $review->rating ? '★' : '☆' }}@endfor
                </span>
                <p>{{ $review->comment }}</p>
                @if(auth()->id() === $review->user_id || auth()->user()->isAdmin())
                    <a class="btn btn-sm" href="{{ route('reviews.edit', $review) }}">Edit</a>
                    <form action="{{ route('reviews.destroy', $review) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-red" type="submit">Delete</button>
                    </form>
                @endif
            </div>
        @empty
            <p>No reviews yet. Be the first!</p>
        @endforelse
    </div>
@endsection
