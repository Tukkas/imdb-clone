<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieSuggestion;
use Illuminate\Http\Request;

class MovieSuggestionController extends Controller
{
    public function create()
    {
        return view('suggestions.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'year' => 'required|integer|min:1888|max:' . date('Y'),
            'description' => 'required',
            'source_link' => 'nullable|url',
        ]);

        MovieSuggestion::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'year' => $request->year,
            'description' => $request->description,
            'source_link' => $request->source_link,
            'status' => 'pending',
        ]);

        return redirect()->route('movies.index')
            ->with('success', 'Movie suggestion submitted.');
    }

    public function index()
    {
        $suggestions = MovieSuggestion::latest()->get();

        return view('suggestions.index', compact('suggestions'));
    }

    public function approve(MovieSuggestion $suggestion)
    {
        Movie::create([
            'title' => $suggestion->title,
            'year' => $suggestion->year,
            'description' => $suggestion->description,
        ]);

        $suggestion->update([
            'status' => 'approved',
        ]);

        return back()->with('success', 'Suggestion approved.');
    }

    public function reject(MovieSuggestion $suggestion)
    {
        $suggestion->update([
            'status' => 'rejected',
        ]);

        return back()->with('success', 'Suggestion rejected.');
    }
}