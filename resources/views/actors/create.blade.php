@extends('layouts.app')

@section('content')
<div class="container">
    <div class="form-shell">
        <div class="mb-4">
            <h1 class="section-title mb-1">Add Actor</h1>
            <p class="page-subtitle">Create a new actor profile.</p>
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

                <form action="{{ route('actors.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Actor Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}">
                    </div>

                    <div class="mb-4">
                        <label for="bio" class="form-label">Bio</label>
                        <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio') }}</textarea>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-dark">Save Actor</button>
                        <a href="{{ route('actors.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection