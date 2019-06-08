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
}
