@extends('layouts.app')
@section('title', 'Edit Vendor')

@section('content')
<div class="form-box">
    <h2>Edit Vendor (ID {{ $vendor->id }})</h2>
    <form method="POST" action="{{ route('vendors.update', $vendor) }}" class="js-validate" novalidate>
        @method('PUT')
        @include('vendors._form')
    </form>
</div>
@endsection
