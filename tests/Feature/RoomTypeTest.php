<?php

namespace Tests\Feature;

use App\Models\RoomType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RoomTypeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/roomtype', [
            'name' => fake()->name(),
            'status' => 1,
        ]);

        // show the error
        // dd($response->getContent());

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $country = RoomType::first();
        $response = $this->put('/roomtype/' . $country->slug, [
            // 'name' => fake(),
            'status' => 0
        ]);

        $response->assertStatus(201);
    }

    public function test_delete(): void
    {
        $country = RoomType::first();
        $response = $this->delete('/roomtype/' . $country->slug);

        $response->assertStatus(201);
    }
}
