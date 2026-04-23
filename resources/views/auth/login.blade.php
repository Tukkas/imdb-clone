@extends('layouts.app')

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <div class="card auth-card">
            <div class="card-body">
                <h1 class="auth-title">Login</h1>
                <p class="page-subtitle mb-4">Sign in to your account.</p>

                @if($errors->any())
                    <div class="alert alert-danger rounded-4">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input id="password" class="form-control" type="password" name="password" required>
                    </div>

                    <div class="form-check mb-4">
                        <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                        <label class="form-check-label" for="remember_me">Remember me</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <button type="submit" class="btn btn-dark">Login</button>

                        @if (Route::has('password.request'))
                            <a class="text-decoration-none" href="{{ route('password.request') }}">
                                Forgot password?
                            </a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection