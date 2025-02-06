<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;

class GenreController extends Controller
{
    public function index(): JsonResponse
    {
        $genres = Genre::all();
        return response()->json($genres);
    }

    public function movies(Genre $genre): JsonResponse
    {
        $movies = $genre->movies()
            ->where('status', 'published')
            ->paginate(10);
            
        return response()->json($movies);
    }
} 