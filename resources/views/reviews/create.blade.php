@extends('layouts.app')
@section('title', 'Write Review')

@section('content')
<div class="form-box">
    <h2>Review: {{ $experience->name }}</h2>
    <form method="POST" action="{{ route('reviews.store', $experience) }}" class="js-validate" novalidate>
        @include('reviews._form')
        <a href="{{ route('experiences.show', $experience) }}" class="btn btn-grey">Cancel</a>
    </form>
</div>
@endsection
