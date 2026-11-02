@extends('layouts.app')
@section('title', 'Vendors')

@section('content')
    <h2>Vendor Profiles</h2>
    <form method="GET" action="{{ route('vendors.index') }}" class="filter-bar">
        <input type="text" name="q" placeholder="Search vendor name or location" value="{{ request('q') }}">
        <button class="btn" type="submit">Search</button>
        <a class="btn btn-grey" href="{{ route('vendors.index') }}">Reset</a>
        <a class="btn btn-green" href="{{ route('vendors.create') }}">+ Add Vendor</a>
    </form>

    @if($vendors->isEmpty())
        <p>No vendors found.</p>
    @else
        <table>
            <thead><tr><th>ID</th><th>Name</th><th>Phone</th><th>Location</th><th>Listings</th><th>Status</th><th>Action</th></tr></thead>
            <tbody>
            @foreach($vendors as $v)
                <tr>
                    <td>{{ $v->id }}</td>
                    <td>{{ $v->name }}</td>
                    <td>{{ $v->phone }}</td>
                    <td>{{ $v->location }}</td>
                    <td>{{ $v->experiences_count }}</td>
                    <td><span class="badge {{ $v->status }}">{{ $v->status }}</span></td>
                    <td>
                        <a class="btn btn-sm" href="{{ route('vendors.edit', $v) }}">Edit</a>
                        @if($v->status === 'inactive')
                            <form action="{{ route('vendors.destroy', $v) }}" method="POST" class="delete-form">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-red" type="submit">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
