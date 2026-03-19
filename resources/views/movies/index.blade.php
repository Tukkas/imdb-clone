@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Movies</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('movies.create') }}" class="btn btn-primary mb-3">Add Movie</a>

    @if($movies->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Year</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->year }}</td>
                        <td>
                            <a href="{{ route('movies.show', $movie) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('movies.destroy', $movie) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No movies found.</p>
    @endif
</div>
@endsection