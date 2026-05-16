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
        }

        .movie-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.12);
        }

        .movie-card .card-title {
            font-size: 1rem;
            font-weight: 600;
        }

        .movie-poster-placeholder {
            height: 180px;
            display: flex;
            align-items: flex-start;
            justify-content: flex-start;
            padding: 1rem;
            color: white;
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(135deg, #6ea8fe, #8eecf5);
        }

        .movie-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
        }

        .movie-card-link:hover {
            text-decoration: none;
            color: inherit;
        }

        .movie-card .card-body {
            padding: 0.75rem;
        }

        .movie-rating {
            font-weight: 600;
            color: #f4b400;
            font-size: 0.9rem;
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

        .form-shell {
            max-width: 820px;
            margin: 0 auto;
        }

        .form-card,
        .admin-table-card,
        .auth-card {
            border: none;
            border-radius: 18px;
            background: #ffffff;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08);
        }

        .form-card .card-body,
        .admin-table-card .card-body,
        .auth-card .card-body {
            padding: 2rem;
        }

        .page-subtitle {
            color: #6c757d;
            margin-bottom: 0;
        }

        .soft-table thead th {
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .soft-table td,
        .soft-table th {
            vertical-align: middle;
        }

        .admin-page-header {
            margin-bottom: 1.5rem;
        }

        .auth-wrapper {
            max-width: 460px;
            margin: 2rem auto;
        }

        .auth-title {
            font-weight: 700;
            margin-bottom: 0.4rem;
        }

        .empty-state {
            background: #ffffff;
            border-radius: 18px;
            padding: 2rem;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06);
            text-align: center;
        }

        .movie-card {
            position: relative;
        }

        .watchlist-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .watchlist-btn form {
            margin: 0;
        }

        .watchlist-btn button {
            font-size: 0.75rem;
            padding: 4px 10px;
            border-radius: 20px;
        }

        .watchlist-btn button {
            opacity: 0.9;
        }

        #actor-results {
            max-height: 250px;
            overflow-y: auto;
            border-radius: 10px;
            margin-top: 5px;
        }

        #actor-results a {
            border: none;
            border-bottom: 1px solid #eee;
        }

        #actor-results a:hover {
            background-color: #f8f9fa;
        }

        .star-rating {
            display: flex;
            gap: 6px;
            flex-wrap: wrap;
            font-size: 2rem;
            cursor: pointer;
            user-select: none;
        }

        .rating-star {
            color: #d1d5db;
            transition: color 0.15s ease;
        }

        .rating-star.active {
            color: #f4b400;
        }

        .rating-star:hover {
            color: #f4b400;
        }

        .actor-tag {
            display: flex;
            align-items: center;
            gap: 8px;
            background: #f1f3f5;
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 0.9rem;
        }

        .actor-tag button {
            border: none;
            background: none;
            color: #dc3545;
            font-weight: bold;
            cursor: pointer;
            padding: 0;
            line-height: 1;
        }

        #actor-picker-results {
            max-height: 220px;
            overflow-y: auto;
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
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('watchlist.index') }}">My Watchlist</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('suggestions.create') }}">Suggest Movie</a>
                        </li>
                    @endauth

                    @auth
                        @if(auth()->user()->role === 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('suggestions.index') }}">Suggestions</a>
                            </li>
                            
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.index') }}">Admin Panel</a>
                            </li>
                        @endif
                    @endauth
                </ul>

                <form class="d-flex position-relative me-auto ms-3"
                    role="search"
                    onsubmit="return false;">

                    <input
                        id="global-search"
                        class="form-control"
                        type="search"
                        placeholder="Search movies or actors..."
                        autocomplete="off">

                    <div id="global-results"
                        class="list-group position-absolute w-100"
                        style="top: 100%; z-index: 1000;">
                    </div>
                </form>

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

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const input = document.getElementById("global-search");
            const resultsBox = document.getElementById("global-results");

            if (!input) return;

            let timeout = null;

            input.addEventListener("keyup", function () {

                clearTimeout(timeout);

                const query = this.value;

                if (query.length < 2) {
                    resultsBox.innerHTML = "";
                    return;
                }

                timeout = setTimeout(() => {

                    fetch(`/search?query=${query}`)
                        .then(response => response.json())
                        .then(data => {

                            resultsBox.innerHTML = "";

                            // MOVIES
                            if (data.movies.length > 0) {

                                const movieHeader =
                                    document.createElement("div");

                                movieHeader.className =
                                    "list-group-item text-muted small fw-bold";

                                movieHeader.textContent = "Movies";

                                resultsBox.appendChild(movieHeader);

                                data.movies.forEach(movie => {

                                    const item =
                                        document.createElement("a");

                                    item.href = `/movies/${movie.id}`;

                                    item.className =
                                        "list-group-item list-group-item-action";

                                    item.textContent = `🎬 ${movie.title}`;

                                    resultsBox.appendChild(item);
                                });
                            }

                            // ACTORS
                            if (data.actors.length > 0) {

                                const actorHeader =
                                    document.createElement("div");

                                actorHeader.className =
                                    "list-group-item text-muted small fw-bold";

                                actorHeader.textContent = "Actors";

                                resultsBox.appendChild(actorHeader);

                                data.actors.forEach(actor => {

                                    const item =
                                        document.createElement("a");

                                    item.href = `/actors/${actor.id}`;

                                    item.className =
                                        "list-group-item list-group-item-action";

                                    item.textContent = `👤 ${actor.name}`;

                                    resultsBox.appendChild(item);
                                });
                            }

                            // NO RESULTS
                            if (
                                data.movies.length === 0 &&
                                data.actors.length === 0
                            ) {

                                resultsBox.innerHTML =
                                    '<div class="list-group-item text-muted">No results</div>';
                            }
                        });

                }, 300);
            });

            document.addEventListener("click", function (e) {

                if (
                    !input.contains(e.target) &&
                    !resultsBox.contains(e.target)
                ) {

                    resultsBox.innerHTML = "";
                }
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const stars = document.querySelectorAll(".rating-star");
            const ratingInput = document.getElementById("rating-value");
            const selectedRating = document.getElementById("selected-rating");

            if (!stars.length) return;

            let selectedValue = 0;

            function highlightStars(value) {
                stars.forEach(s => {
                    s.classList.remove("active");

                    if (parseInt(s.dataset.value) <= value) {
                        s.classList.add("active");
                    }
                });
            }

            stars.forEach(star => {

                // hover preview
                star.addEventListener("mouseenter", function () {
                    const value = parseInt(this.dataset.value);
                    highlightStars(value);
                });

                // click selection
                star.addEventListener("click", function () {
                    selectedValue = parseInt(this.dataset.value);

                    ratingInput.value = selectedValue;
                    selectedRating.textContent = selectedValue;

                    highlightStars(selectedValue);
                });
            });

            // restore selected rating when leaving stars area
            const starContainer = document.querySelector(".star-rating");

            starContainer.addEventListener("mouseleave", function () {
                highlightStars(selectedValue);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const searchInput = document.getElementById("actor-picker-search");

            if (!searchInput) return;

            const resultsBox = document.getElementById("actor-picker-results");
            const selectedBox = document.getElementById("selected-actors");

            let selectedActors = {};

            if (window.preloadedActors) {

                window.preloadedActors.forEach(actor => {

                    selectedActors[actor.id] = actor.name;
                });

                renderSelectedActors();
            }

            searchInput.addEventListener("keyup", function () {

                const query = this.value;

                if (query.length < 2) {
                    resultsBox.innerHTML = "";
                    return;
                }

                fetch(`/actors/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {

                        resultsBox.innerHTML = "";

                        data.forEach(actor => {

                            if (selectedActors[actor.id]) {
                                return;
                            }

                            const item = document.createElement("button");

                            item.type = "button";
                            item.className = "list-group-item list-group-item-action";
                            item.textContent = actor.name;

                            item.addEventListener("click", function () {

                                selectedActors[actor.id] = actor.name;

                                renderSelectedActors();

                                resultsBox.innerHTML = "";
                                searchInput.value = "";
                            });

                            resultsBox.appendChild(item);
                        });
                    });
            });

            function renderSelectedActors() {

                selectedBox.innerHTML = "";

                Object.entries(selectedActors).forEach(([id, name]) => {

                    const tag = document.createElement("div");
                    tag.className = "actor-tag";

                    tag.innerHTML = `
                        <span>${name}</span>

                        <button type="button" data-id="${id}">
                            ×
                        </button>

                        <input type="hidden" name="actors[]" value="${id}">
                    `;

                    tag.querySelector("button").addEventListener("click", function () {

                        delete selectedActors[id];

                        renderSelectedActors();
                    });

                    selectedBox.appendChild(tag);
                });
            }
        });
    </script>
</body>
</html>