@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Genres</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('genres.create') }}" class="btn btn-primary mb-3">Add Genre</a>

    @if($genres->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($genres as $genre)
                    <tr>
                        <td>{{ $genre->name }}</td>
                        <td>
                            <a href="{{ route('genres.show', $genre) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('genres.destroy', $genre) }}" method="POST" style="display:inline;">
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
        <p>No genres found.</p>
    @endif
</div>
@endsection