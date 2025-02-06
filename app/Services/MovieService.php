<?php

namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MovieService
{
    public function create(array $data, ?UploadedFile $poster = null): Movie
    {
        $movie = new Movie([
            'title' => $data['title'],
            'status' => 'draft',
            'poster_url' => $poster ? $this->storePoster($poster) : null
        ]);

        $movie->save();
        $movie->genres()->attach($data['genre_ids']);

        return $movie;
    }

    public function update(Movie $movie, array $data, ?UploadedFile $poster = null): Movie
    {
        if ($poster) {
            $this->deletePoster($movie->poster_url);
            $movie->poster_url = $this->storePoster($poster);
        }

        $movie->update([
            'title' => $data['title']
        ]);

        $movie->genres()->sync($data['genre_ids']);

        return $movie;
    }

    public function delete(Movie $movie): void
    {
        $this->deletePoster($movie->poster_url);
        $movie->delete();
    }

    private function storePoster(UploadedFile $file): string
    {
        $path = $file->store('posters', 'public');
        return Storage::url($path);
    }

    private function deletePoster(?string $posterUrl): void
    {
        if ($posterUrl) {
            Storage::delete(str_replace('/storage/', '/public/', $posterUrl));
        }
    }
} 