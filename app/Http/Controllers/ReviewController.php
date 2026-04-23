<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(Request $request, Movie $movie)
    {
        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'movie_id' => $movie->id,
            'body' => $request->body,
        ]);

        return redirect()->route('movies.show', $movie)->with('success', 'Review added successfully.');
    }

    public function update(Request $request, Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403, 'You can only edit your own reviews.');
        }

        $request->validate([
            'body' => 'required|string|min:3',
        ]);

        $review->update([
            'body' => $request->body,
        ]);

        return redirect()->route('movies.show', $review->movie_id)->with('success', 'Review updated successfully.');
    }

    public function destroy(Review $review)
    {
        if ($review->user_id !== auth()->id()) {
            abort(403, 'You can only delete your own reviews.');
        }

        $movieId = $review->movie_id;
        $review->delete();

        return redirect()->route('movies.show', $movieId)->with('success', 'Review deleted successfully.');
    }
}