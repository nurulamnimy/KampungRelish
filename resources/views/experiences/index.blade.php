@extends('layouts.app')
@section('title', 'Experiences')

@section('content')
    <h2>Food Experiences</h2>

    {{-- SEARCH + FILTER + SORT (GET parameters) --}}
    <form method="GET" action="{{ route('experiences.index') }}" class="filter-bar">
        <input type="text" name="q" placeholder="Search name or location" value="{{ request('q') }}">
        <select name="category">
            <option value="">All categories</option>
            @foreach($categories as $cat)
                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
            @endforeach
        </select>
        <select name="sort">
            <option value="">Sort by ID</option>
            <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
            <option value="name" {{ request('sort') == 'name' ? 'selected' : '' }}>Name A-Z</option>
        </select>
        <button class="btn" type="submit">Search</button>
        <a class="btn btn-grey" href="{{ route('experiences.index') }}">Reset</a>
        @if(auth()->user()->isAdmin())
            <a class="btn btn-green" href="{{ route('experiences.create') }}">+ Add Experience</a>
        @endif
    </form>

    @if($experiences->isEmpty())
        <p>No experiences found.</p>
    @else
        <table>
            <thead>
                <tr><th>ID</th><th>Name</th><th>Vendor</th><th>Location</th><th>Category</th><th>Price (RM)</th><th>Rating</th><th>Status</th><th>Action</th></tr>
            </thead>
            <tbody>
            @foreach($experiences as $exp)
                <tr>
                    <td>{{ $exp->id }}</td>
                    <td>{{ $exp->name }}</td>
                    <td>{{ $exp->vendor->name }}</td>
                    <td>{{ $exp->location }}</td>
                    <td>{{ $exp->category }}</td>
                    <td>{{ number_format($exp->price, 2) }}</td>
                    <td>{{ $exp->reviews_avg_rating ? number_format($exp->reviews_avg_rating, 1) . ' / 5' : '-' }}</td>
                    <td><span class="badge {{ $exp->status }}">{{ $exp->status }}</span></td>
                    <td>
                        <a class="btn btn-sm btn-green" href="{{ route('experiences.show', $exp) }}">View</a>
                        @if(auth()->user()->isAdmin())
                            <a class="btn btn-sm" href="{{ route('experiences.edit', $exp) }}">Edit</a>
                            @if($exp->status === 'inactive')
                                <form action="{{ route('experiences.destroy', $exp) }}" method="POST" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-red" type="submit">Delete</button>
                                </form>
                            @endif
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <p>Total: {{ $experiences->count() }} experience(s) | Average price: RM {{ number_format($experiences->avg('price'), 2) }}</p>
    @endif
@endsection
