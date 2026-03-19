@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $movie->title }}</h1>

    <p><strong>Year:</strong> {{ $movie->year }}</p>
    <p><strong>Description:</strong> {{ $movie->description }}</p>

    <a href="{{ route('movies.index') }}" class="btn btn-secondary">Back to Movies</a>
    <a href="{{ route('movies.edit', $movie) }}" class="btn btn-warning">Edit</a>
</div>
@endsection