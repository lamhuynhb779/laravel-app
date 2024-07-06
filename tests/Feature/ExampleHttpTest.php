<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleHttpTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_the_app_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_interacting_with_headers()
    {
        $response = $this->withHeaders([
            'X-Header' => 1,
        ])->post('/api/login', [
            'email' => 'test@gmail.com',
            'password' => '123456789'
        ]);

        $response->assertStatus(200);
    }

    public function test_interacting_with_cookies()
    {
        $response = $this->withCookie('color', 'red')->get('/');
        $response->assertStatus(200);

        $response = $this->withCookies(['color' => 'blue', 'name' => 'Lam'])->get('/');
        $response->assertStatus(200);
    }

    public function test_interacting_with_the_session()
    {
        $response = $this->withSession(['banned' => false])->get('/');
        $response->assertStatus(200);
    }

    public function test_an_action_that_requires_authentication()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user, 'web')
            ->withSession(['banned' => false])
            ->get('/');

        $response->assertStatus(200);
    }
}
