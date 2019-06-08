<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function can_generate_token()
    {
        $user = factory(User::class)->create();

        $token = $user->generateToken();

        $this->assertEquals($token, $user->api_token);

    }
}
