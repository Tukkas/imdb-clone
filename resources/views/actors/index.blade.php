@extends('layouts.app')

@section('content')
<div class="container">
    <div class="admin-page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="section-title mb-1">Actors</h1>
            <p class="page-subtitle">Manage the actors stored in the system.</p>
        </div>
        <a href="{{ route('actors.create') }}" class="btn btn-dark">Add Actor</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if($actors->count())
        <div class="card admin-table-card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table soft-table align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($actors as $actor)
                                <tr>
                                    <td>{{ $actor->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('actors.show', $actor) }}" class="btn btn-outline-dark btn-sm">View</a>
                                        <a href="{{ route('actors.edit', $actor) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                        <form action="{{ route('actors.destroy', $actor) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this actor?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @else
        <div class="empty-state">
            <h5 class="mb-2">No actors found</h5>
            <p class="text-muted mb-0">Add actors to start connecting them to movies.</p>
        </div>
    @endif
</div>
@endsection