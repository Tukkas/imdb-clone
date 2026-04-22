<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin', [AdminController::class, 'index'])
    ->name('admin.index')
    ->middleware('admin');

Route::resource('movies', MovieController::class)
    ->except(['index', 'show'])
    ->middleware('admin');

Route::post('/movies/{movie}/rate', [RatingController::class, 'store'])
    ->name('movies.rate')
    ->middleware('auth');

Route::resource('movies', MovieController::class)->only(['index', 'show']);

Route::resource('genres', GenreController::class)->middleware('admin');

Route::resource('actors', ActorController::class)->middleware('admin');