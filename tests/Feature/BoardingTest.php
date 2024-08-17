<?php

namespace Tests\Feature;

use App\Models\Boarding;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BoardingTest extends TestCase
{
    public function test_store()
    {
        $response = $this->post('/boarding', [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'status' => random_int(1, 2),
            'place' => random_int(1, 3)
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $boarding = Boarding::first();
        $response = $this->put('/boarding/' . $boarding->id, [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
            'status' => random_int(1, 2),
            'place' => random_int(1, 3)
        ]);

        $response->assertStatus(201);
    }
}
