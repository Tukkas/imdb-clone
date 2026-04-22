@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="section-title mb-1">Movies</h1>
            <p class="text-muted mb-0">Browse the movie collection.</p>
        </div>

        @auth
            @if(auth()->user()->role === 'admin')
                <a href="{{ route('movies.create') }}" class="btn btn-dark">Add Movie</a>
            @endif
        @endauth
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if($movies->count())
        <div class="row g-4">
            @foreach($movies as $movie)
                <div class="col-12 col-sm-6 col-lg-4 col-xl-3">
                    <div class="card movie-card">
                        <div class="movie-poster-placeholder">
                            {{ strtoupper(substr($movie->title, 0, 1)) }}
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h5 class="card-title mb-0">{{ $movie->title }}</h5>
                                <span class="movie-rating">
                                    ★ {{ $movie->ratings->count() ? number_format($movie->ratings->avg('value'), 1) : 'N/A' }}
                                </span>
                            </div>

                            <p class="movie-meta mb-2">{{ $movie->year }}</p>

                            <p class="text-muted small mb-3">
                                {{ \Illuminate\Support\Str::limit($movie->description, 80) }}
                            </p>

                            <div class="mb-3">
                                @forelse($movie->genres as $genre)
                                    <span class="badge rounded-pill genre-badge">{{ $genre->name }}</span>
                                @empty
                                    <span class="text-muted small">No genres assigned</span>
                                @endforelse
                            </div>

                            <div class="mt-auto action-buttons">
                                <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-dark btn-sm">View Details</a>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <a href="{{ route('movies.edit', $movie) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                        <form action="{{ route('movies.destroy', $movie) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this movie?')">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    @else
        <div class="alert alert-light border rounded-4">
            No movies found.
        </div>
    @endif
</div>
@endsection