<?php

namespace Tests\Feature;

use App\Models\Agency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AgencyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/agency', [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => 1,
            'is_home' => 1,
        ]);

        $response->assertStatus(201);
    }

    public function test_update()
    {
        $slug = Agency::first()->slug;
        // dd($slug);
        $response = $this->put('/agency/' . $slug, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => 1,
            'is_home' => 1,
        ]);
        // dd($response->getContent());
        $response->assertStatus(201);
    }
}
