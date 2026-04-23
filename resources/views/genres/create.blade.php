@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <div class="mb-4">
            <h1 class="section-title mb-1">Add Genre</h1>
            <p class="page-subtitle">Create a new genre for classifying movies.</p>
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

                <form action="{{ route('genres.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label for="name" class="form-label">Genre Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark">Save Genre</button>
                        <a href="{{ route('genres.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection