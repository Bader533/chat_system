<?php

namespace Tests\Feature;

use App\Models\City;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/city', [
            'name' => fake()->name(),
            'country_id' => fake()->numberBetween(3, 9),
            'status' => 1,
        ]);

        // show the error
        // dd($response->getContent());

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $city = City::first();
        $response = $this->put('/city/' . $city->slug, [
            // 'name' => fake(),
            'status' => 0
        ]);

        $response->assertStatus(201);
    }

    // public function test_delete(): void
    // {
    //     $city = City::first();
    //     $response = $this->delete('/city/' . $city->slug);

    //     $response->assertStatus(201);
    // }
}
