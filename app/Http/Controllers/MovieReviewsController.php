<?php

namespace App\Http\Controllers;

use App\Movie;
use Illuminate\Support\Facades\Auth;

class MovieReviewsController extends Controller
{
    public function store($id)
    {
        $user = Auth::user();

        $movie = Movie::findOrFail($id);

        $request = request([
            'rating',
            'review',
            'recommend'
        ]);
        $request["user_id"] = $user->id;


        $review = $movie->reviews()->create($request);

        return response()->json($review, 201);
    }
}
