<?php

namespace Tests\Feature;

use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTest extends TestCase
{
    // protected function setUp(): void
    // {
    //     parent::setUp();
    //     $this->user = User::where('email', 'bader@gmail.com')->first();
    //     if (!$this->user) {
    //         $this->markTestSkipped('User not found in the database.');
    //     }
    //     $this->actingAs($this->user);
    // }

    public function test_store(): void
    {
        $response = $this->post('/api/room', [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
            'country_id' => 4,
            'city_id' => 2,
            'is_home' => 1,
            'is_favorite' => 0,
            'room_type_id' => 2,
        ]);

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $room = Room::first();
        $response = $this->put('/api/room/' . $room->id, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => fake()->numberBetween(0, 1),
            'country_id' => 4,
            'city_id' => 2,
            'room_type_id' => 2,
        ]);

        $response->assertStatus(201);
    }
}
