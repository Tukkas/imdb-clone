@extends('layouts.app')

@section('content')
<div class="container">
    <div class="admin-page-header d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h1 class="section-title mb-1">Genres</h1>
            <p class="page-subtitle">Manage the movie genres available in the system.</p>
        </div>
        <a href="{{ route('genres.create') }}" class="btn btn-dark">Add Genre</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if($genres->count())
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
                            @foreach($genres as $genre)
                                <tr>
                                    <td>{{ $genre->name }}</td>
                                    <td class="text-end">
                                        <a href="{{ route('genres.show', $genre) }}" class="btn btn-outline-dark btn-sm">View</a>
                                        <a href="{{ route('genres.edit', $genre) }}" class="btn btn-outline-primary btn-sm">Edit</a>

                                        <form action="{{ route('genres.destroy', $genre) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-outline-danger btn-sm"
                                                onclick="return confirm('Are you sure you want to delete this genre?')">
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
            <h5 class="mb-2">No genres found</h5>
            <p class="text-muted mb-0">Create your first genre to start organizing movies.</p>
        </div>
    @endif
</div>
@endsection