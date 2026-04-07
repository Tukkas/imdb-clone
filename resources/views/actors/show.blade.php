@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>{{ $actor->name }}</h1>

    <p><strong>Bio:</strong> {{ $actor->bio }}</p>

    <a href="{{ route('actors.index') }}" class="btn btn-secondary">Back to Actors</a>
    <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning">Edit</a>
</div>
@endsection