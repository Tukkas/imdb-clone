@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary btn-sm mb-4">← Back to Genres</a>

        <div class="card form-card">
            <div class="card-body">
                <h1 class="section-title mb-2">{{ $genre->name }}</h1>
                <p class="page-subtitle mb-4">Genre details page.</p>

                <a href="{{ route('genres.edit', $genre) }}" class="btn btn-primary">Edit Genre</a>
            </div>
        </div>
    </div>
</div>
@endsection