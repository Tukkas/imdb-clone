@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $movie->title }}</h1>

    <p>
        <strong>Average Rating:</strong>
        {{ $movie->ratings->count() ? number_format($movie->ratings->avg('value'), 1) : 'No ratings yet' }}
    </p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Description:</strong> {{ $movie->description }}</p>

    <p><strong>Genres:</strong>
        @forelse($movie->genres as $genre)
            <span class="badge bg-primary">{{ $genre->name }}</span>
        @empty
            No genres assigned.
        @endforelse
    </p>

    <p><strong>Actors:</strong></p>
    <ul>
        @forelse($movie->actors as $actor)
            <li>{{ $actor->name }}</li>
        @empty
            <li>No actors assigned.</li>
        @endforelse
    </ul>

    @auth
        <hr>
        <h4>Rate this movie</h4>

        <form action="{{ route('movies.rate', $movie) }}" method="POST" class="mb-3">
            @csrf

            <div class="mb-3">
                <label for="value" class="form-label">Your Rating (1-10)</label>
                <input type="number" name="value" id="value" class="form-control" min="1" max="10" required>
            </div>

            <button type="submit" class="btn btn-success">Submit Rating</button>
        </form>
    @endauth

    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Back to Movies</a>
    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Edit</a>
</div>
@endsection