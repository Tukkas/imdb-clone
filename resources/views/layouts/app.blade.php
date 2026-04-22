<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IMDb Clone</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f6f8;
            color: #212529;
            font-family: Arial, Helvetica, sans-serif;
        }

        .navbar-brand {
            font-weight: 700;
            letter-spacing: 0.3px;
        }

        .page-section {
            padding-top: 2rem;
            padding-bottom: 2rem;
        }

        .movie-card {
            border: none;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            background: #ffffff;
            height: 100%;
        }

        .movie-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        .movie-poster-placeholder {
            height: 320px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 1rem;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6ea8fe, #8eecf5);
        }

        .movie-rating {
            font-weight: 600;
            color: #f4b400;
        }

        .movie-meta {
            font-size: 0.95rem;
            color: #6c757d;
        }

        .genre-badge {
            background-color: #e9ecef;
            color: #495057;
            font-weight: 500;
            margin-right: 0.35rem;
            margin-bottom: 0.35rem;
        }

        .details-card {
            border: none;
            border-radius: 18px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .poster-large {
            height: 420px;
            border-radius: 18px;
            color: white;
            font-size: 5rem;
            font-weight: 700;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 1.5rem;
            background: linear-gradient(135deg, #6ea8fe, #8eecf5);
        }

        .section-title {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .action-buttons .btn {
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .navbar {
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container">
            <a class="navbar-brand" href="{{ route('movies.index') }}">MovieBase</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainNavbar">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('movies.index') }}">Movies</a>
                    </li>

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Admin Panel</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <ul class="navbar-nav ms-auto align-items-lg-center">
                    @auth
                        <li class="nav-item">
                            <span class="nav-link">Hello, {{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="mb-0">
                                @csrf
                                <button type="submit" class="btn btn-outline-dark btn-sm ms-lg-2">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item me-lg-2">
                            <a class="btn btn-outline-dark btn-sm" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-dark btn-sm" href="{{ route('register') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <main class="page-section">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>