@extends('layouts.app')

@section('content')

<div class="container py-4">

    <h1 class="mb-4">Movie Suggestions</h1>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body">

            @forelse($suggestions as $suggestion)

                <div class="border-bottom pb-4 mb-4">

                    <h4>{{ $suggestion->title }}</h4>

                    <div class="text-muted mb-2">
                        {{ $suggestion->year }}
                    </div>

                    <p>{{ $suggestion->description }}</p>

                    @if($suggestion->source_link)
                        <a href="{{ $suggestion->source_link }}"
                            target="_blank">
                            Source Link
                        </a>
                    @endif

                    <div class="mt-3">
                        <span class="badge bg-secondary">
                            {{ ucfirst($suggestion->status) }}
                        </span>
                    </div>

                    @if($suggestion->status === 'pending')

                        <div class="d-flex gap-2 mt-3">

                            <form method="POST"
                                action="{{ route('suggestions.approve', $suggestion) }}">

                                @csrf

                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>

                            <form method="POST"
                                action="{{ route('suggestions.reject', $suggestion) }}">

                                @csrf

                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>
                        </div>

                    @endif

                </div>

            @empty

                <p>No suggestions found.</p>

            @endforelse

        </div>
    </div>
</div>

@endsection