<?php

namespace Tests\Feature;

use Tests\TestCase;

class AddMovieTest extends TestCase
{
    /** @test */
    function user_can_create_a_movie()
    {

        $this->withoutExceptionHandling();

        $payload = [
            'name' => "test name",
            'release_year' => "2018",
            'image' => 'test url',
            'plot' => 'test plot',
            'country' => 'test country',
            'imdb_id' => 'test imdb'
        ];

        $response = $this->json('POST', '/api/movies', $payload);

        $response->assertStatus(201);

    }
}
