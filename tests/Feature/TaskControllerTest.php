<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{

    public function test_authenticated_user_can_create_task() {
        // arrange -> act -> assert
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
        ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => [
                         'id',
                         'title',
                         'description',
                         'created_at',
                         'updated_at',
                     ],
                 ]);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
            'user_id' => $user->id,
        ]);


    }

    public function test_guest_cannot_create_task() {
        // arrange -> act -> assert
        $response = $this->postJson('/api/tasks', [
            'title' => 'New Task',
            'description' => 'Task description',
        ]);

        $response->assertStatus(401); // Unauthorized
    }

    public function test_task_requires_title() {
        // arrange -> act -> assert 
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $response = $this->postJson('/api/tasks', [
            'description' => 'Task description',
        ]);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors('title');
    }


    public function test_authenticated_user_can_update_task() {

        // arrang -> act -> assert
        $user = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $task = \App\Models\Task::factory()->create([
            'user_id' => $user->id,
            'title' => 'Old Title',
            'description' => 'Old description',
        ]);

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated description',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'title' => 'Updated Title',
                     'description' => 'Updated description',
                 ]);

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Updated Title',
            'description' => 'Updated description',
        ]);

    }

    public function test_guest_user_cannot_update_task() {
        // arrange
        $task = \App\Models\Task::factory()->create([
            'title' => 'Old Title',
            'description' => 'Old description',
        ]);

        // act
        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Updated Title',
            'description' => 'Updated description',
        ]);

        // assert
        $response->assertStatus(401); // Unauthorized

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Old Title',
            'description' => 'Old description',
        ]);
        
    }

    // ownership test
    public function test_user_cannot_update_others_task() {
        // arrange
        $user = \App\Models\User::factory()->create();
        $otherUser = \App\Models\User::factory()->create();

        $this->actingAs($user);

        $task = \App\Models\Task::factory()->create([
            'user_id' => $otherUser->id,
            'title' => 'Other User Task',
            'description' => 'Other description',
        ]);

        // act
        $response = $this->putJson("/api/tasks/{$task->id}", [
            'title' => 'Hacked Title',
            'description' => 'Hacked description',
        ]);

        // assert
        $response->assertStatus(403); // Forbidden

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'title' => 'Other User Task',
            'description' => 'Other description',
        ]);
    }
 
}
