<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Rating;
use Illuminate\Http\Request;

class RatingController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'value' => 'required|integer|min:1|max:10',
        ]);

        Rating::updateOrCreate(
            [
                'user_id' => auth()->id(),
                'movie_id' => $movie->id,
            ],
            [
                'value' => $request->value,
            ]
        );

        return redirect()->route('movies.show', $movie)->with('success', 'Rating saved successfully.');
    }
}