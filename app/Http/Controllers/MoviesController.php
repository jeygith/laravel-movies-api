<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Http\Request;

class MoviesController extends Controller
{

    public function index()
    {
        return Movie::all();
    }

    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return $movie;
    }

    public function store()
    {

        $movie = Movie::create([
            'name' => request('name'),
            'release_year' => request('release_year'),
            'image' => request('image'),
            'plot' => request('plot'),
            'country' => request('country'),
            'imdb_id' => request('imdb_id')
        ]);


        return response()->json($movie, 201);
    }

    public function update(Request $request, $id)
    {
        $movie = Movie::findorFail($id);


        $movie->update($request->all());

        return response()->json($movie, 200);
    }

    public function delete($id)
    {
        $movie = Movie::findorFail($id);

        $movie->delete();

        return response()->json(null, 204);

    }
}
