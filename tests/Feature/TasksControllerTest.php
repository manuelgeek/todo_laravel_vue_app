<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class TasksControllerTest extends TestCase
{
    public function test_tasks_resource_needs_auth()
    {
        $response = $this->getJson('/api/v1/tasks');

        $response->assertStatus(401);
    }

    public function test_get_all_tasks()
    {
        $this->setAuth();
        $response = $this->getJson('/api/v1/tasks');

        $response
            ->assertStatus(200)
            ->assertJson( function (AssertableJson $json) {
            $json->has('pagination');
            $json->has('tasks');
        });
    }

    public function test_show_task()
    {
        $this->setAuth();
        $task = auth()->user()->tasks()->first();

        $response = $this->getJson('/api/v1/tasks/'. $task->slug);
        $response
            ->assertStatus(200);
    }

    public function test_show_missing_task()
    {
        $this->setAuth();

        $response = $this->getJson('/api/v1/tasks/'. 'no-task');
        $response
            ->assertStatus(404)
            ->assertNotFound();
    }

    public function test_store_task_validation_errors()
    {
        $this->setAuth();

        $response = $this->postJson('/api/v1/tasks', []);
        $expected = '{
            "message": "The given data was invalid.",
            "errors": {
                "title": [
                    "The title field is required."
                ],
                "description": [
                    "The description field is required."
                ],
                "category_id": [
                    "The category id field is required."
                ]
            }
        }';

        $response->assertStatus(422);
        $this->assertJson($expected, json_encode($response));
    }

    public function test_store_task()
    {
        $this->setAuth();

        $data = [
            'title' => 'Hiking ...',
            'is_public' => true,
            'status' => 'todo',
            'category_id' => 0 // default category
        ];
        $response = $this->postJson('/api/v1/tasks', $data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['task' => []]);
    }

    public function test_update_task()
    {
        $this->setAuth();
        $data = [
            'title' => 'Hiking ...',
            'is_public' => true,
            'status' => 'todo',
            'category_id' => 0 // default category
        ];

        $task = auth()->user()->tasks()->first();

        $response = $this->putJson('/api/v1/tasks/'. $task->slug, $data);
        $response->assertStatus(201);
        $response->assertJsonStructure(['task' => []]);
    }

    public function test_update_task_status_with_wrong_status()
    {
        $this->setAuth();
        $data = [
            'status' => 'wrong'
        ];
        $task = auth()->user()->tasks()->first();
        $response = $this->putJson('/api/v1/tasks/'. $task->slug . '/status', $data);
        $response->assertStatus(422)->assertJsonValidationErrors('status');
    }
    public function test_update_task_status()
    {
        $this->setAuth();
        $data = [
            'status' => 'done'
        ];
        $task = auth()->user()->tasks()->first();
        $response = $this->putJson('/api/v1/tasks/'. $task->slug . '/status', $data);
        $response->assertJsonStructure(['task' => []]);
    }

    public function test_update_visibility()
    {
        $this->setAuth();
        $task = auth()->user()->tasks()->first();
        $response = $this->getJson('/api/v1/tasks/'. $task->slug . '/visibility')->decodeResponseJson();
        $status = ($task->is_public ? 'public' : 'private') !== $response['task']['visibility'];
        $this->assertTrue($status);
    }

    public function test_destroy_task()
    {
        $this->setAuth();
        $task = auth()->user()->tasks()->first();
        $response = $this->deleteJson('/api/v1/tasks/'. $task->slug);
        $response->assertStatus(200);
    }

    private function setAuth()
    {
        $user = User::whereEmail('james@example.com')->first();
        $this->be($user);
    }

}
