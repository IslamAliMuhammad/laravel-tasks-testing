<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{

    use RefreshDatabase;

    public function test_user_can_register()
    {
        $payload = [
            'name' => 'John Doe',
            'email' => 'john@gmail.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ];

        $response = $this->postJson('/api/register', $payload);

        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ],
                'token'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => 'john@gmail.com',
        ]);

    }

    public function test_user_can_login() {

        # Arrange: Create a user in the database
        $user = \App\Models\User::factory()->create([
            'email' => 'John@gmail.com',
            'password' => bcrypt('password123')
        ]);

        # Act: Send a post request to the login endpoint with the created user's creadentials 
        $response = $this->postJson('/api/login', [
            'email' => 'John@gmail.com',
            'password' => 'password123'
        ]);

        # Assert: Check the response status code is 200 and the JSON structure contains expected fields.
        $response->assertStatus(200)
            ->assertJsonStructure([
                'user' => [
                    'id',
                    'name',
                    'email',
                    'created_at',
                    'updated_at'
                ],
                'token'
            ]);

    }
}
