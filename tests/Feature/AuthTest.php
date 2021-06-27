<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_UnauhorizedUsersAreRedirectedToLogin()
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_LoginViewExists()
    {
        $response = $this->get('/login');
        $response->assertOk();
        $response->assertViewIs('Auth.login');
    }

    public function test_WrongCredentialsFailToLogin()
    {
        $this->get('/login');
        $response = $this->post('/login');
        $response->assertRedirect('/login');
        $response->assertSessionHasErrorsIn('email');
    }

    public function test_CorrectCredentialsPassLogin()
    {
        $user = User::factory()
                    ->create();

        $this->get('/login');
        $response = $this->post('/login', [
            'email'    => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
    }

    public function test_wrongApiCredentialsRedirectToLogin()
    {
        $response = $this->get('/api/game-session');
        $response->assertRedirect('/login');
    }

    public function test_correctApiCredentialsGiveData()
    {
        $user = User::factory()
                    ->create();

        $response = $this->actingAs($user, 'api')
                         ->get("/api/game-session");
        $response->assertOk();
    }
}
