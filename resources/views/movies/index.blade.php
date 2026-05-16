@extends('layouts.app')

@section('content')
@php
    $watchlistIds = auth()->check() ? auth()->user()->watchlistMovies->pluck('id')->toArray() : [];
@endphp
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
        <div class="row g-3">
            @foreach($movies as $movie)
               <div class="col-6 col-sm-3 col-lg-3 col-xl-2">
                    <a href="{{ route('movies.show', $movie) }}" class="movie-card-link">
                        <div class="card movie-card">
                            @auth
                                <div class="watchlist-btn" onclick="event.stopPropagation();">
                                    @if(in_array($movie->id, $watchlistIds))
                                        <form action="{{ route('watchlist.destroy', $movie) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-light btn-sm">
                                                Watchlist
                                            </button>
                                        </form>
                                    @else
                                        <form action="{{ route('watchlist.store', $movie) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-dark btn-sm">
                                                Watchlist
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @endauth
                            <div class="movie-poster-placeholder">
                                {{ strtoupper(substr($movie->title, 0, 1)) }}
                            </div>

                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-1">
                                    <h5 class="card-title mb-0">{{ $movie->title }}</h5>
                                    <span class="movie-rating">
                                        ★ {{ $movie->ratings->count() ? number_format($movie->ratings->avg('value'), 1) : 'N/A' }}
                                    </span>
                                </div>

                                <p class="movie-meta mb-2">{{ $movie->year }}</p>

                                <div>
                                    @forelse($movie->genres as $genre)
                                        <span class="badge rounded-pill genre-badge">{{ $genre->name }}</span>
                                    @empty
                                        <span class="text-muted small">No genres assigned</span>
                                    @endforelse
                                </div>

                                @auth
                                    @if(auth()->user()->role === 'admin')
                                        <div class="d-flex gap-2 mt-3">
                                            <a href="{{ route('movies.edit', $movie) }}"
                                                class="btn btn-outline-primary btn-sm flex-fill">
                                                Edit
                                            </a>

                                            <form action="{{ route('movies.destroy', $movie) }}"
                                                method="POST"
                                                class="flex-fill">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                    class="btn btn-outline-danger btn-sm w-100"
                                                    onclick="return confirm('Are you sure you want to delete this movie?')">

                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </a>

                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex flex-column align-items-center gap-2">
            {{ $movies->links() }}

            <div class="text-muted small">
                Showing {{ $movies->firstItem() }} to {{ $movies->lastItem() }}
                of {{ $movies->total() }} results
            </div>
        </div>
    @else
        <div class="alert alert-light border rounded-4">
            No movies found.
        </div>
    @endif
</div>
@endsection