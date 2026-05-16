<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WatchlistController;
use App\Http\Controllers\MovieSuggestionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/movies');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('admin');

Route::get('/search', [MovieController::class, 'globalSearch'])
    ->name('search.global');

Route::resource('movies', MovieController::class)
    ->except(['index', 'show'])
    ->middleware('admin');

Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])
    ->name('movies.rate')
    ->middleware('auth');

Route::resource('movies', MovieController::class)->only(['index', 'show']);

Route::resource('genres', GenreController::class)->middleware('admin');

Route::get('/actors/search', [ActorController::class, 'search'])
    ->name('actors.search');

Route::resource('actors', ActorController::class)
    ->except(['index', 'show'])
    ->middleware('admin');

Route::resource('actors', ActorController::class)->only(['index', 'show']);

Route::post('/movies/{movie}/reviews', [ReviewController::class, 'store'])
    ->name('reviews.store')
    ->middleware('auth');

Route::put('/reviews/{review}', [ReviewController::class, 'update'])
    ->name('reviews.update')
    ->middleware('auth');

Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])
    ->name('reviews.destroy')
    ->middleware('auth');

Route::post('/movies/{movie}/watchlist', [WatchlistController::class, 'store'])
    ->name('watchlist.store')
    ->middleware('auth');

Route::delete('/movies/{movie}/watchlist', [WatchlistController::class, 'destroy'])
    ->name('watchlist.destroy')
    ->middleware('auth');

Route::get('/watchlist', [WatchlistController::class, 'index'])
    ->name('watchlist.index')
    ->middleware('auth');

// USER ROUTES
Route::get('/suggest-movie', [MovieSuggestionController::class, 'create'])
    ->middleware('auth')
    ->name('suggestions.create');

Route::post('/suggest-movie', [MovieSuggestionController::class, 'store'])
    ->middleware('auth')
    ->name('suggestions.store');

// ADMIN ROUTES
Route::get('/admin/suggestions', [MovieSuggestionController::class, 'index'])
    ->middleware('admin')
    ->name('suggestions.index');

Route::post('/admin/suggestions/{suggestion}/approve',
    [MovieSuggestionController::class, 'approve'])
    ->middleware('admin')
    ->name('suggestions.approve');

Route::post('/admin/suggestions/{suggestion}/reject',
    [MovieSuggestionController::class, 'reject'])
    ->middleware('admin')
    ->name('suggestions.reject');