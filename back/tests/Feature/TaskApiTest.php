<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_create_update_and_delete_tasks(): void
    {
        // Create
        $createResponse = $this->postJson('/api/tasks', [
            'title' => 'Nouvelle tâche API',
            'description' => 'Tester le serveur Laravel',
            'priority' => 'Élevée',
            'status' => 'À faire',
        ]);

        $createResponse->assertStatus(201)
            ->assertJsonFragment([
                'title' => 'Nouvelle tâche API',
                'description' => 'Tester le serveur Laravel',
                'priority' => 'Élevée',
                'status' => 'À faire',
            ]);

        $taskId = $createResponse->json('id');
        $this->assertNotNull($createResponse->json('createdAt'));

        // List
        $listResponse = $this->getJson('/api/tasks');
        $listResponse->assertStatus(200)
            ->assertJsonCount(1);

        // Show
        $showResponse = $this->getJson("/api/tasks/{$taskId}");
        $showResponse->assertStatus(200)
            ->assertJsonFragment(['title' => 'Nouvelle tâche API']);

        // Update
        $updateResponse = $this->putJson("/api/tasks/{$taskId}", [
            'title' => 'Tâche modifiée',
            'description' => 'Description modifiée',
            'priority' => 'Moyenne',
            'status' => 'Terminée',
        ]);
        $updateResponse->assertStatus(200)
            ->assertJsonFragment([
                'title' => 'Tâche modifiée',
                'status' => 'Terminée',
                'priority' => 'Moyenne',
            ]);

        // Delete
        $deleteResponse = $this->deleteJson("/api/tasks/{$taskId}");
        $deleteResponse->assertStatus(200);

        $this->assertDatabaseCount('tasks', 0);
    }
}
