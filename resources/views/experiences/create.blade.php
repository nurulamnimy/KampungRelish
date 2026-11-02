@extends('layouts.app')
@section('title', 'Add Experience')

@section('content')
<div class="form-box wide">
    <h2>Add Food Experience</h2>
    <form method="POST" action="{{ route('experiences.store') }}" class="js-validate" novalidate>
        @include('experiences._form')
    </form>
</div>
@endsection
