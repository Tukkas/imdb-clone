@extends('layouts.app')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-body">
                <h1 class="auth-title">Register</h1>
                <p class="page-subtitle mb-4">Create a new account.</p>

                @if($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark">Register</button>
                        <a class="text-decoration-none" href="{{ route('login') }}">Already registered?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection