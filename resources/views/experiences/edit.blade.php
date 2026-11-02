@extends('layouts.app')
@section('title', 'Edit Experience')

@section('content')
<div class="form-box wide">
    <h2>Edit Food Experience (ID {{ $experience->id }})</h2>
    <form method="POST" action="{{ route('experiences.update', $experience) }}" class="js-validate" novalidate>
        @method('PUT')
        @include('experiences._form')
    </form>
</div>
@endsection
