<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    public function index(): JsonResponse
    {
        $movies = Movie::where('status', 'published')
            ->paginate(10);
            
        return response()->json($movies);
    }

    public function show(Movie $movie): JsonResponse
    {
        return response()->json($movie);
    }
} 