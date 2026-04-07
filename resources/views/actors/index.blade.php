@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Actors</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('actors.create') }}" class="btn btn-primary mb-3">Add Actor</a>

    @if($actors->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actors as $actor)
                    <tr>
                        <td>{{ $actor->name }}</td>
                        <td>
                            <a href="{{ route('actors.show', $actor) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('actors.edit', $actor) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('actors.destroy', $actor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No actors found.</p>
    @endif
</div>
@endsection