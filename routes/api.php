<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\GenreController;
use App\Http\Controllers\Api\MovieController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('genres', [GenreController::class, 'index']);
Route::get('genres/{genre}/movies', [GenreController::class, 'movies']);
Route::get('movies', [MovieController::class, 'index']);
Route::get('movies/{movie}', [MovieController::class, 'show']);
