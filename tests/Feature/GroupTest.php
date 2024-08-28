<?php

namespace Tests\Feature;

use App\Models\Group;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GroupTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/api/group', [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);

        $response->assertStatus(200);
    }

    public function test_update(): void
    {
        $group = Group::first();
        $response = $this->put('/api/group/' . $group->id, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);

        $response->assertStatus(200);
    }
}
