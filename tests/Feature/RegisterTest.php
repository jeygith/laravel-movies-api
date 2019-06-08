<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function user_registers_successfully()
    {
        $this->withoutExceptionHandling();
        $payload = [
            'name' => 'jeff',
            'email' => 'githireh@gmail.com',
            'password' => 'pass',
            'password_confirmation' => 'pass'
        ];

        $response = $this->json('POST', '/api/register', $payload);


        $response->assertStatus(201);

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
                'api_token'
            ]
        ]);

    }
}
