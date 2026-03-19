<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('movies.index', compact('movies'));
    }

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);

        Movie::create([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie created successfully.');
    }

    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movies.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'nullable|string',
        ]);

        $movie->update([
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
        ]);

        return redirect()->route('movies.index')->with('success', 'Movie updated successfully.');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();

        return redirect()->route('movies.index')->with('success', 'Movie deleted successfully.');
    }
}