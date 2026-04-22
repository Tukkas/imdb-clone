@extends('layouts.app')

@section('content')
<div class="container">
    <a href="{{ route('movies.index') }}" class="btn btn-outline-secondary btn-sm mb-4">← Back to Movies</a>

    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="row g-4">
        <div class="col-lg-4">
            <div class="poster-large">
                {{ strtoupper(substr($movie->title, 0, 1)) }}
            </div>
        </div>

        <div class="col-lg-8">
            <div class="card details-card">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-3">
                        <div>
                            <h1 class="mb-1">{{ $movie->title }}</h1>
                            <p class="text-muted mb-0">{{ $movie->year }}</p>
                        </div>
                        <div class="text-end">
                            <div class="movie-rating fs-5">
                                ★ {{ $movie->ratings->count() ? number_format($movie->ratings->avg('value'), 1) : 'N/A' }}
                            </div>
                            <small class="text-muted">{{ $movie->ratings->count() }} rating(s)</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        @forelse($movie->genres as $genre)
                            <span class="badge rounded-pill genre-badge">{{ $genre->name }}</span>
                        @empty
                            <span class="text-muted">No genres assigned.</span>
                        @endforelse
                    </div>

                    <div class="mb-4">
                        <h5>Description</h5>
                        <p class="mb-0">{{ $movie->description ?: 'No description available.' }}</p>
                    </div>

                    <div class="mb-4">
                        <h5>Actors</h5>
                        <ul class="mb-0">
                            @forelse($movie->actors as $actor)
                                <li>{{ $actor->name }}</li>
                            @empty
                                <li>No actors assigned.</li>
                            @endforelse
                        </ul>
                    </div>

                    <div class="action-buttons">
                        @auth
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('movies.edit', $movie) }}" class="btn btn-primary">Edit Movie</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>

            @auth
                <div class="card details-card mt-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Rate this movie</h4>

                        <form action="{{ route('movies.rate', $movie) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="value" class="form-label">Your Rating (1–10)</label>
                                <input type="number" name="value" id="value" class="form-control" min="1" max="10" required>
                            </div>

                            <button type="submit" class="btn btn-dark">Submit Rating</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>
    </div>
</div>
@endsection