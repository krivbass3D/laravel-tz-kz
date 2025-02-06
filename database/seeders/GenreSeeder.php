<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    public function run()
    {
        $genres = [
            ['name' => 'Action'],
            ['name' => 'Comedy'],
            ['name' => 'Drama'],
            ['name' => 'Horror'],
            ['name' => 'Science Fiction'],
            ['name' => 'Thriller'],
            ['name' => 'Adventure'],
            ['name' => 'Romance'],
        ];

        foreach ($genres as $genre) {
            DB::table('genres')->insert([
                'name' => $genre['name'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
} 