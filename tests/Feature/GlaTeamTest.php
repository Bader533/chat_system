<?php

namespace Tests\Feature;

use App\Models\GlaTeam;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GlaTeamTest extends TestCase
{
    public function test_store(): void
    {
        $response = $this->post('/gla-team', [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);
        // dd($response->getContent());
        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $team = GlaTeam::first();
        $response = $this->put('/gla-team/' . $team->slug, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);
        $response->assertStatus(201);
    }

    public function test_delete(): void
    {
        $team = GlaTeam::first();
        $response = $this->delete('/gla-team/' . $team->slug);
        $response->assertStatus(201);
    }
}
