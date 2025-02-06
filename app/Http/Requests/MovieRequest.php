<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MovieRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'genre_ids' => 'required|array',
            'genre_ids.*' => 'exists:genres,id'
        ];
    }
} 