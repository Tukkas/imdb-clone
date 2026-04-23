@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <a href="{{ route('actors.index') }}" class="btn btn-outline-secondary btn-sm mb-4">← Back to Actors</a>

        <div class="card form-card">
            <div class="card-body">
                <h1 class="section-title mb-2">{{ $actor->name }}</h1>
                <p class="page-subtitle mb-4">Actor details page.</p>

                <div class="mb-4">
                    <h5>Biography</h5>
                    <p class="mb-0">{{ $actor->bio ?: 'No biography available.' }}</p>
                </div>

                <a href="{{ route('actors.edit', $actor) }}" class="btn btn-primary">Edit Actor</a>
            </div>
        </div>
    </div>
</div>
@endsection