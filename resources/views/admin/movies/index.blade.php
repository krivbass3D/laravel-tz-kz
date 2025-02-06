@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Movies</h1>
            <a href="{{ route('admin.movies.create') }}" class="btn btn-primary">Add Movie</a>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Poster</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Genres</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($movies as $movie)
                    <tr>
                        <td>{{ $movie->id }}</td>
                        <td>
                            <img src="{{ $movie->poster_url ?? $movie->getDefaultPosterUrl() }}" 
                                 alt="{{ $movie->title }}" 
                                 style="max-width: 50px;">
                        </td>
                        <td>{{ $movie->title }}</td>
                        <td>{{ $movie->status }}</td>
                        <td>
                            {{ $movie->genres->pluck('name')->join(', ') }}
                        </td>
                        <td class="d-flex gap-2">
                            @if($movie->status === 'draft')
                                <form action="{{ route('admin.movies.publish', $movie) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">Publish</button>
                                </form>
                            @endif
                            <a href="{{ route('admin.movies.edit', $movie) }}" 
                               class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.movies.destroy', $movie) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $movies->links() }}
    </div>
@endsection 