<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/post', [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'status' => 1,
            // 'user_id' => 1,

        ]);

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $data = Post::first();
        $response = $this->put('/post/' . $data->slug, [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'status' => 1,
            // 'user_id' => 1,

        ]);

        $response->assertStatus(201);
    }

    public function test_delete(): void
    {
        $data = Post::first();
        $response = $this->delete('/post/' . $data->slug);

        $response->assertStatus(201);
    }
}
