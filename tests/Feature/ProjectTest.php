<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_cannot_create_project(): void
    {
        $response = $this->postJson('/api/projects', [
            'title' => 'Proyecto test',
            'description' => 'Descripción de prueba',
            'technologies' => 'Laravel, Vue, Docker',
        ]);

        $response->assertStatus(401);
    }

    public function test_authenticated_user_can_create_project(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $data = [
            'title' => 'Proyecto test',
            'description' => 'Descripción de prueba',
            'technologies' => 'Laravel, Vue, Docker',
        ];

        $response = $this->postJson('/api/projects', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('projects', [
            'title' => 'Proyecto test',
            'description' => 'Descripción de prueba',
            'technologies' => 'Laravel, Vue, Docker',
        ]);
    }

    public function test_authenticated_user_can_update_project(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $project = Project::create([
            'title' => 'Proyecto original',
            'description' => 'Descripción original',
            'technologies' => 'Laravel',
        ]);

        $response = $this->putJson("/api/projects/{$project->id}", [
            'title' => 'Proyecto actualizado',
            'description' => 'Descripción actualizada',
            'technologies' => 'Laravel, Vue, Docker',
        ]);

        $response->assertStatus(200);

        $this->assertDatabaseHas('projects', [
            'id' => $project->id,
            'title' => 'Proyecto actualizado',
            'description' => 'Descripción actualizada',
            'technologies' => 'Laravel, Vue, Docker',
        ]);
    }

    public function test_authenticated_user_can_delete_project(): void
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $project = Project::create([
            'title' => 'Proyecto a borrar',
            'description' => 'Descripción de prueba',
            'technologies' => 'Laravel',
        ]);

        $response = $this->deleteJson("/api/projects/{$project->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('projects', [
            'id' => $project->id,
        ]);
    }
}
