<?php

namespace Tests\Feature;

use App\Movie;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddReviewTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_can_add_movie_review()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $token = $user->generateToken();

        $headers = ['Authorization' => "Bearer $token"];

        $movie = factory(Movie::class)->create();

        $payload = [
            'rating' => 5,
            'review' => 'average movie',
            'recommend' => true
        ];

        $response = $this->json('POST', "/api/movies/$movie->id/reviews", $payload, $headers);


        $response->assertStatus(201);

        $response->dump();

    }

    /** @test */
    function a_guest_cannot_create_review()
    {

        $movie = factory(Movie::class)->create();

        $payload = [
            'rating' => 5,
            'review' => 'average movie',
            'recommend' => true
        ];

        $response = $this->json('POST', "/api/movies/$movie->id/reviews", $payload);

        $response->assertStatus(401);

    }
}
