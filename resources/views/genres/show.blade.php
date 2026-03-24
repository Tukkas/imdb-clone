@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $genre->name }}</h1>

    <a href="{{ route('genres.index') }}" class="btn btn-secondary">Back to Genres</a>
    <a href="{{ route('genres.edit', $genre) }}" class="btn btn-warning">Edit</a>
</div>
@endsection