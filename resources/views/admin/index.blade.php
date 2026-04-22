@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Admin Panel</h1>
    <p class="mb-4">Use this panel to manage the main data of the system.</p>

    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Movies</h5>
                    <p class="card-text">Create, edit, and delete movies.</p>
                    <a href="{{ route('movies.index') }}" class="btn btn-primary">Go to Movies</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Genres</h5>
                    <p class="card-text">Create, edit, and delete genres.</p>
                    <a href="{{ route('genres.index') }}" class="btn btn-primary">Go to Genres</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Manage Actors</h5>
                    <p class="card-text">Create, edit, and delete actors.</p>
                    <a href="{{ route('actors.index') }}" class="btn btn-primary">Go to Actors</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection