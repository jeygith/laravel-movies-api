<?php

namespace Tests\Feature;

use App\User;
use Auth;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function logging_out_an_authenticated_user()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        Auth::login($user);

        $response = $this->post('/api/logout');

        $response->assertStatus(200);

        $this->assertFalse(Auth::check());

        $user = User::find($user->id);

        $this->assertEquals(null, $user->api_token);
    }
}
