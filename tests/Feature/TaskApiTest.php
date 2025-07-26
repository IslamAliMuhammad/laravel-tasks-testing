<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $payload = [
            'title' => 'Buy groceries',
            'description' => 'Milk, eggs, bread'
        ];

        $response = $this->postJson('/api/tasks', $payload);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'task' => [
                    'id',
                    'title',
                    'description',
                    'created_at',
                    //  'updated_at'
                ]
            ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'Buy groceries',
            'description' => 'Milk, eggs, bread'
        ]);
    }
}
