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

            @auth
                <div class="card details-card mt-4">
                    <div class="card-body p-4">
                        <h4 class="mb-3">Write a Review</h4>

                        @if($errors->any())
                            <div class="alert alert-danger rounded-4">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('reviews.store', $movie) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="body" class="form-label">Your Review</label>
                                <textarea name="body" id="body" rows="4" class="form-control" required>{{ old('body') }}</textarea>
                            </div>

                            <button type="submit" class="btn btn-dark">Post Review</button>
                        </form>
                    </div>
                </div>
            @endauth

            <div class="card details-card mt-4">
                <div class="card-body p-4">
                    <h4 class="mb-3">Reviews</h4>

                    @if($movie->reviews->count())
                        <div class="d-flex flex-column gap-3">
                            @foreach($movie->reviews as $review)
                                <div class="border rounded-4 p-3">
                                    <div class="d-flex justify-content-between align-items-start flex-wrap gap-2 mb-2">
                                        <div>
                                            <strong>{{ $review->user->name }}</strong>
                                            <div class="text-muted small">
                                                {{ $review->created_at->format('Y-m-d H:i') }}
                                            </div>
                                        </div>

                                        @auth
                                            @if(auth()->id() === $review->user_id)
                                                <div class="d-flex gap-2">
                                                    <button class="btn btn-outline-primary btn-sm" type="button"
                                                        data-bs-toggle="collapse"
                                                        data-bs-target="#editReview{{ $review->id }}">
                                                        Edit
                                                    </button>

                                                    <form action="{{ route('reviews.destroy', $review) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm"
                                                            onclick="return confirm('Delete this review?')">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        @endauth
                                    </div>

                                    <p class="mb-0">{{ $review->body }}</p>

                                    @auth
                                        @if(auth()->id() === $review->user_id)
                                            <div class="collapse mt-3" id="editReview{{ $review->id }}">
                                                <form action="{{ route('reviews.update', $review) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-2">
                                                        <textarea name="body" rows="3" class="form-control" required>{{ $review->body }}</textarea>
                                                    </div>

                                                    <button type="submit" class="btn btn-dark btn-sm">Save Changes</button>
                                                </form>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted mb-0">No reviews yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection