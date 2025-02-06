@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Add New Movie</h1>

        <form action="{{ route('admin.movies.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" 
                       class="form-control @error('title') is-invalid @enderror" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}" 
                       required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="poster" class="form-label">Poster</label>
                <input type="file" 
                       class="form-control @error('poster') is-invalid @enderror" 
                       id="poster" 
                       name="poster">
                @error('poster')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Genres</label>
                <div class="row">
                    @foreach(\App\Models\Genre::all() as $genre)
                        <div class="col-md-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       name="genre_ids[]" 
                                       value="{{ $genre->id }}" 
                                       id="genre{{ $genre->id }}"
                                       @checked(in_array($genre->id, old('genre_ids', [])))>
                                <label class="form-check-label" for="genre{{ $genre->id }}">
                                    {{ $genre->name }}
                                </label>
                            </div>
                        </div>
                    @endforeach
                </div>
                @error('genre_ids')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create Movie</button>
            <a href="{{ route('admin.movies.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection 