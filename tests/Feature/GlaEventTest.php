<?php

namespace Tests\Feature;

use App\Models\GlaEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GlaEventTest extends TestCase
{
    public function test_store(): void
    {
        $response = $this->post('/gla-event', [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);
        // dd($response->getContent());
        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $room = GlaEvent::first();
        $response = $this->put('/gla-event/' . $room->slug, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
        ]);
        $response->assertStatus(201);
    }

    public function test_delete(): void
    {
        $room = GlaEvent::first();
        $response = $this->delete('/gla-event/' . $room->slug);
        $response->assertStatus(201);
    }
}
