<?php

namespace Tests\Feature;


use App\Movie;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AddMovieTest extends TestCase
{
    use DatabaseMigrations;

    private function validParams($overrides = [])
    {
        return array_merge([
            'name' => "test name",
            'release_year' => "2018",
            'image' => 'test url',
            'plot' => 'test plot',
            'country' => 'test country',
            'imdb_id' => 'test imdb'
        ], $overrides);
    }


    /** @test */
    function user_can_create_a_movie()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $token = $user->generateToken();


        $headers = ['Authorization' => "Bearer $token"];

        $payload = [
            'name' => "test name",
            'release_year' => "2018",
            'image' => 'test url',
            'plot' => 'test plot',
            'country' => 'test country',
            'imdb_id' => 'test imdb'
        ];

        $response = $this->json('POST', '/api/movies', $payload, $headers);

        $response->assertStatus(201);

    }

    /** @test */
    function guest_cannot_create_a_movie()
    {

        $payload = [
            'name' => "test name",
            'release_year' => "2018",
            'image' => 'test url',
            'plot' => 'test plot',
            'country' => 'test country',
            'imdb_id' => 'test imdb'
        ];

        $response = $this->json('POST', '/api/movies', $payload);

        $response->assertStatus(401);

    }

    /** @test */
    function user_can_edit_movie()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $token = $user->generateToken();

        $headers = ['Authorization' => "Bearer $token"];


        $movie = factory(Movie::class)->create();

        $response = $this->json('PATCH', "/api/movies/{$movie->id}", $this->validParams(['plot' => 'this is a test edit']), $headers);

        $response->assertStatus(200);

        tap($movie->fresh(), function ($movie) {
            $this->assertEquals('this is a test edit', $movie->plot);
        });

    }

    /** @test */
    function guest_cannot_edit_movie()
    {

        $movie = factory(Movie::class)->create();

        $response = $this->json('PATCH', "/api/movies/{$movie->id}", $this->validParams(['plot' => 'this is a test edit']));

        $response->assertStatus(401);
    }


    /** @test */
    function user_can_delete_movie()
    {

        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $token = $user->generateToken();

        $headers = ['Authorization' => "Bearer $token"];

        $movie = factory(Movie::class)->create();

        $response = $this->json('DELETE', "/api/movies/{$movie->id}", [], $headers);

        $response->assertStatus(204);

    }


    /** @test */
    function guest_cannot_delete_movie()
    {


        $movie = factory(Movie::class)->create();

        $response = $this->json('DELETE', "/api/movies/{$movie->id}", []);

        $response->assertStatus(401);

    }

}
