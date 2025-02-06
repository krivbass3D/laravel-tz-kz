<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MovieRequest;
use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class MovieController extends Controller
{
    public function __construct(
        private MovieService $movieService
    ) {}

    public function index(): View
    {
        $movies = Movie::paginate(10);
        return view('admin.movies.index', compact('movies'));
    }

    public function create(): View
    {
        return view('admin.movies.create');
    }

    public function store(MovieRequest $request): RedirectResponse
    {
        $this->movieService->create(
            $request->validated(),
            $request->file('poster')
        );

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie created successfully');
    }

    public function edit(Movie $movie): View
    {
        return view('admin.movies.edit', compact('movie'));
    }

    public function update(MovieRequest $request, Movie $movie): RedirectResponse
    {
        $this->movieService->update(
            $movie,
            $request->validated(),
            $request->file('poster')
        );

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully');
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        $this->movieService->delete($movie);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie deleted successfully');
    }

    public function publish(Movie $movie): RedirectResponse
    {
        $movie->publish();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie published successfully');
    }
} 