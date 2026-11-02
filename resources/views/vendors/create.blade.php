@extends('layouts.app')
@section('title', 'Add Vendor')

@section('content')
<div class="form-box">
    <h2>Add Vendor</h2>
    <form method="POST" action="{{ route('vendors.store') }}" class="js-validate" novalidate>
        @include('vendors._form')
    </form>
</div>
@endsection
