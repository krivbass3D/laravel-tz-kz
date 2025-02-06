<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MovieSeeder extends Seeder
{
    public function run()
    {
        $movies = [
            [
                'title' => 'Матрица',
                'status' => 'published',
                'poster_url' => 'https://static.hdrezka.ac/i/2014/1/22/h4442e483f19aey57g75d.jpg',
                'genres' => [1, 5]
            ],
            [
                'title' => 'Начало',
                'status' => 'published',
                'poster_url' => 'https://static.hdrezka.ac/i/2021/11/2/kcad758381af1ow79z45o.jpeg',
                'genres' => [1, 5, 6]
            ],
            [
                'title' => 'Побег из Шоушенка',
                'status' => 'published',
                'poster_url' => 'https://static.hdrezka.ac/i/2021/3/6/o41759bd352dazn54q16d.jpeg',
                'genres' => [3]
            ],
            [
                'title' => 'Upcoming Movie',
                'status' => 'draft',
                'poster_url' => null,
                'genres' => [2, 7]
            ],
        ];

        foreach ($movies as $movie) {
            $movieId = DB::table('movies')->insertGetId([
                'title' => $movie['title'],
                'status' => $movie['status'],
                'poster_url' => $movie['poster_url'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // Создаем связи с жанрами
            foreach ($movie['genres'] as $genreId) {
                DB::table('genre_movie')->insert([
                    'movie_id' => $movieId,
                    'genre_id' => $genreId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
