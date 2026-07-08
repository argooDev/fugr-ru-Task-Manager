<?php

namespace Tests\Feature;

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
   use RefreshDatabase;


    public function test_can_create_task() {
        $data = Task::factory()->make()->toArray();

        $response = $this->postJson('/api/tasks', $data);

        $response->assertStatus(201);

        $this->assertDatabaseHas('tasks', ['title' => $data['title']]);
    }

    public function test_can_get_tasks_list() {
        Task::factory()->count(5)->create();
        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200);
    }
    
    public function test_can_get_task_by_id() {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");

        $response->assertStatus(200);

    }

    public function test_can_update_task() {
        $task = Task::factory()->create();

        $response = $this->patchJson("/api/tasks/{$task->id}", [
            'title' => 'Updated title'
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated title'
        ]);
    }

    public function test_can_delete_task(){
        $task = Task::factory()->create();

        $response = $this->deleteJson("api/tasks/{$task->id}");

        $response->assertStatus(200);

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id
        ]);
    }
}
