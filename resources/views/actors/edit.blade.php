@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Edit Actor</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('actors.update', $actor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Actor Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $actor->name) }}">
        </div>

        <div class="mb-3">
            <label for="bio" class="form-label">Bio</label>
            <textarea name="bio" id="bio" class="form-control" rows="5">{{ old('bio', $actor->bio) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Update Actor</button>
        <a href="{{ route('actors.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection