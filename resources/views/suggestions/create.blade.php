@extends('layouts.app')

@section('content')

<div class="container py-4">

    <div class="card shadow-sm border-0 rounded-4">
        <div class="card-body p-4">

            <h1 class="mb-4">Suggest a Movie</h1>

            <form action="{{ route('suggestions.store') }}" method="POST">

                @csrf

                <div class="mb-3">
                    <label class="form-label">Title</label>

                    <input type="text"
                        name="title"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Year</label>

                    <input type="number"
                        name="year"
                        class="form-control"
                        required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>

                    <textarea name="description"
                        rows="5"
                        class="form-control"
                        required></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Source Link</label>

                    <input type="url"
                        name="source_link"
                        class="form-control">
                </div>

                <button class="btn btn-dark">
                    Submit Suggestion
                </button>

            </form>
        </div>
    </div>
</div>

@endsection