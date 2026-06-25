<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_login(): void
    {
        User::factory()->create([
            'name' => 'Alexander',
            'email' => 'alexandergalvez880208@gmail.com',
            'password' => bcrypt('Temporal12345'),
        ]);

        $response = $this->postJson('/api/login', [
            'email' => 'alexandergalvez880208@gmail.com',
            'password' => 'Temporal12345',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'message',
                'token',
                'user' => ['id', 'name', 'email'],
            ]);
    }

    public function test_verify_auth_returns_authenticated_user(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->getJson('/api/verify-auth');

        $response->assertStatus(200)
            ->assertJsonPath('authenticated', true)
            ->assertJsonStructure([
                'authenticated',
                'user' => ['id', 'name', 'email'],
            ]);
    }

    public function test_user_can_logout(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/logout');

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Sesión cerrada correctamente',
            ]);
    }
}
