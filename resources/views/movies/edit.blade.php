@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <div class="mb-4">
            <h1 class="section-title mb-1">Edit Movie</h1>
            <p class="page-subtitle">Update the selected movie entry.</p>
        </div>

        <div class="card form-card">
            <div class="card-body">
                @if($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('movies.update', $movie) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $movie->title) }}">
                    </div>

                    <div class="mb-3">
                        <label for="year" class="form-label">Year</label>
                        <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $movie->year) }}">
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea name="description" id="description" class="form-control" rows="5">{{ old('description', $movie->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Genres</label>
                        <div class="row">
                            @foreach($genres as $genre)
                                <div class="col-md-6 mb-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="genres[]" value="{{ $genre->id }}"
                                            id="genre{{ $genre->id }}"
                                            {{ $movie->genres->contains($genre->id) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="genre{{ $genre->id }}">
                                            {{ $genre->name }}
                                        </label>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Actors</label>

                        <input
                            type="text"
                            id="actor-picker-search"
                            class="form-control"
                            placeholder="Search actors..."
                            autocomplete="off"
                        >

                        <div id="actor-picker-results" class="list-group mt-2"></div>

                        <div id="selected-actors"
                            class="d-flex flex-wrap gap-2 mt-3">
                        </div>

                        <script>
                            window.preloadedActors = @json(
                                $movie->actors->map(function($actor) {
                                    return [
                                        'id' => $actor->id,
                                        'name' => $actor->name
                                    ];
                                })
                            );
                        </script>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="submit" class="btn btn-dark">Update Movie</button>
                        <a href="{{ route('movies.show', $movie) }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection