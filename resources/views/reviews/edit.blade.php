@extends('layouts.app')
@section('title', 'Edit Review')

@section('content')
<div class="form-box">
    <h2>Edit Review</h2>
    <form method="POST" action="{{ route('reviews.update', $review) }}" class="js-validate" novalidate>
        @method('PUT')
        @include('reviews._form')
        <a href="{{ route('experiences.show', $review->experience_id) }}" class="btn btn-grey">Cancel</a>
    </form>
</div>
@endsection
