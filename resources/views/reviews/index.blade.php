@extends('layouts.app')
@section('title', 'All Reviews')

@section('content')
    <h2>All Reviews</h2>
    <input type="text" id="tableSearch" placeholder="Type to search in table..." style="max-width:300px">
    @if($reviews->isEmpty())
        <p>No reviews found.</p>
    @else
        <table class="searchable">
            <thead><tr><th>No</th><th>Experience</th><th>Reviewer</th><th>Rating</th><th>Comment</th><th>Action</th></tr></thead>
            <tbody>
            @foreach($reviews as $r)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $r->experience->name }}</td>
                    <td>{{ $r->user->name }}</td>
                    <td>{{ $r->rating }} / 5</td>
                    <td>{{ $r->comment }}</td>
                    <td>
                        <form action="{{ route('reviews.destroy', $r) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-red" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif
@endsection
