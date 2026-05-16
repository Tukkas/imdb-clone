<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class WatchlistController extends Controller
{
    public function index()
    {
        $movies = auth()->user()
            ->watchlistMovies()
            ->with(['genres', 'ratings'])
            ->latest('watchlists.created_at')
            ->paginate(20);

        return view('watchlist.index', compact('movies'));
    }

    public function store(Movie $movie)
    {
        auth()->user()->watchlistMovies()->syncWithoutDetaching([$movie->id]);

        return redirect()->back()->with('success', 'Movie added to your watchlist.');
    }

    public function destroy(Movie $movie)
    {
        auth()->user()->watchlistMovies()->detach($movie->id);

        return redirect()->back()->with('success', 'Movie removed from your watchlist.');
    }
}