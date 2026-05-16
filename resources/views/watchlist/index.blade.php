@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <div>
            <h1 class="section-title mb-1">My Watchlist</h1>
            <p class="text-muted mb-0">Movies you saved to watch later.</p>
        </div>
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
                            </div>
                        </div>
                    </a>

                    <div class="mt-3">
                        <form action="{{ route('watchlist.destroy', $movie) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm">
                                Remove from Watchlist
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $movies->links() }}
        </div>
    @else
        <div class="empty-state">
            <h5 class="mb-2">Your watchlist is empty</h5>
            <p class="text-muted mb-0">Start adding movies you want to save for later.</p>
        </div>
    @endif
</div>
@endsection