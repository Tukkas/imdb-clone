@extends('layouts.app')

@section('content')
<div class="container">
    <div class="mb-4">
        <h1 class="section-title mb-1">Admin Panel</h1>
        <p class="page-subtitle">Manage the main data of the movie platform.</p>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card movie-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Movies</h5>
                    <p class="text-muted">Create, edit, and delete movie entries.</p>
                    <a href="{{ route('movies.index') }}" class="btn btn-dark">Open Movies</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card movie-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Genres</h5>
                    <p class="text-muted">Maintain the available movie genres.</p>
                    <a href="{{ route('genres.index') }}" class="btn btn-dark">Open Genres</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card movie-card h-100">
                <div class="card-body">
                    <h5 class="card-title">Manage Actors</h5>
                    <p class="text-muted">Add and update actor information.</p>
                    <a href="{{ route('actors.index') }}" class="btn btn-dark">Open Actors</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection