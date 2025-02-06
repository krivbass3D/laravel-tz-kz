<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Movie extends Model
{
    protected $fillable = ['title', 'poster_url', 'status'];

    protected $with = ['genres'];

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function getDefaultPosterUrl(): string
    {
        return asset('images/default-poster.jpg');
    }

    public function publish(): void
    {
        $this->status = 'published';
        $this->save();
    }
} 