<?php

namespace Tests\Feature;

use App\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function log_in_with_valid_credentials()
    {
        $this->withoutExceptionHandling();
        $user = factory(User::class)->create([
            'email' => 'testlogin@gmail.com',
            'password' => bcrypt('pass')
        ]);


        $payload = [
            'email' => 'testlogin@gmail.com',
            'password' => 'pass'
        ];
        $response = $this->json('POST', '/api/login', $payload);


        $response->assertStatus(200);

        $this->assertTrue(Auth::check());


        $this->assertTrue(Auth::user()->is($user));


    }

    /** @test */
    function log_in_with_invalid_credentials()
    {
        $user = factory(User::class)->create([
            'email' => 'testlogin@gmail.com',
            'password' => bcrypt('pass')
        ]);


        $payload = [
            'email' => 'testlogin@gmail.com',
            'password' => 'wrong-pass'
        ];
        $response = $this->json('POST', '/api/login', $payload);


        $response->assertStatus(422);

        $this->assertFalse(Auth::check());

    }
}
