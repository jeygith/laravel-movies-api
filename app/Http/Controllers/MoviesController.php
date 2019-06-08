<?php

namespace App\Http\Controllers;

use App\Movie;

class MoviesController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return $movie;
    }

    public function store()
    {

        $movie = create([
            'name' => request('name'),
            'release_year' => request('release_year'),
            'image' => request('image'),
            'plot' => request('plot'),
            'country' => request('country'),
            'imdb_id' => request('imdb_id')
        ]);

        return response()->json($movie, 201);
    }
}
