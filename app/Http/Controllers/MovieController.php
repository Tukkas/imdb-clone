<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index(Request $request)
    {
        $query = Movie::query()
            ->with(['genres', 'ratings']);

        // SEARCH
        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        // GENRE FILTER
        if ($request->filled('genre')) {

            $query->whereHas('genres', function ($q) use ($request) {

                $q->where('genres.id', $request->genre);
            });
        }

        // YEAR FILTER
        if ($request->filled('year')) {

            $query->where('year', $request->year);
        }

        // MINIMUM RATING FILTER
        if ($request->filled('rating')) {

            $query->whereHas('ratings', function ($q) use ($request) {

                $q->selectRaw('AVG(value)')
                    ->groupBy('movie_id')
                    ->havingRaw('AVG(value) >= ?', [$request->rating]);
            });
        }

        // SORTING
        switch ($request->sort) {

            case 'newest':
                $query->orderBy('year', 'desc');
                break;

            case 'oldest':
                $query->orderBy('year', 'asc');
                break;

            case 'title_asc':
                $query->orderBy('title', 'asc');
                break;

            case 'title_desc':
                $query->orderBy('title', 'desc');
                break;

            default:
                $query->latest();
        }

        $movies = $query->paginate(20)->withQueryString();

        $genres = Genre::orderBy('name')->get();

        return view('movies.index', compact('movies', 'genres'));
    }

    public function create()
    {
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.create', compact('genres', 'actors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'actors' => 'nullable|array',
            'actors.*' => 'exists:actors,id',
        ]);

        $movie = Movie::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
        ]);

        if ($request->has('genres')) {
            $movie->genres()->sync($request->genres);
        }

        if ($request->has('actors')) {
            $actorData = [];
            foreach ($request->actors as $actorId) {
                $actorData[$actorId] = ['character_name' => null];
            }
            $movie->actors()->sync($actorData);
        }

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    public function show(Movie $movie)
    {
        $movie->load(['genres', 'actors', 'ratings', 'reviews.user']);
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        $actors = Actor::all();

        return view('movies.edit', compact('movie', 'genres', 'actors'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'nullable|string',
            'genres' => 'nullable|array',
            'genres.*' => 'exists:genres,id',
            'actors' => 'nullable|array',
            'actors.*' => 'exists:actors,id',
        ]);

        $movie->update([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
        ]);

        $movie->genres()->sync($request->genres ?? []);

        $actorData = [];
        if ($request->has('actors')) {
            foreach ($request->actors as $actorId) {
                $actorData[$actorId] = ['character_name' => null];
            }
        }
        $movie->actors()->sync($actorData);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function globalSearch(Request $request)
    {
        $query = $request->get('query');

        $movies = Movie::where('title', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'title']);

        $actors = Actor::where('name', 'like', '%' . $query . '%')
            ->limit(5)
            ->get(['id', 'name']);

        return response()->json([
            'movies' => $movies,
            'actors' => $actors,
        ]);
    }
    
    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}