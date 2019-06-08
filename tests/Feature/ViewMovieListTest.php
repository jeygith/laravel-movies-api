<?php

namespace Tests\Feature;

use App\Movie;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ViewMovieListTest extends TestCase
{

    use DatabaseMigrations;

    /** @test */
    function user_can_view_movie_list()
    {
        $this->withoutExceptionHandling();


        // arrange
        // create movie

        $movie = factory(Movie::class)->create([
            'name' => "Avengers Infinity War",
            'release_year' => "2018",
            'image' => 'https://upload.wikimedia.org/wikipedia/en/4/4d/Avengers_Infinity_War_poster.jpg',
            'plot' => 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.',
            'country' => 'USA',
            'imdb_id' => 'tt4154756'
        ]);


        // act

        $response = $this->json('GET', '/api/movies/' . $movie->id);
        // assert

        $response->assertStatus(200);


        $response->assertJson([
            'id' => 1,
            'name' => "Avengers Infinity War",
            'release_year' => "2018",
            'image' => 'https://upload.wikimedia.org/wikipedia/en/4/4d/Avengers_Infinity_War_poster.jpg',
            'plot' => 'The Avengers and their allies must be willing to sacrifice all in an attempt to defeat the powerful Thanos before his blitz of devastation and ruin puts an end to the universe.',
            'country' => 'USA',
            'imdb_id' => 'tt4154756'
        ]);

        $response->assertJson($movie->toArray());


    }
}
