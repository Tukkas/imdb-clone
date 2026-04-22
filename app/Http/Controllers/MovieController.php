<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Genre;
use App\Models\Actor;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::with(['genres', 'ratings'])->latest()->paginate(20);
        return view('movies.index', compact('movies'));
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
        $movie->load('genres', 'actors', 'ratings');
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

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}