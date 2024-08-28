<?php

namespace Tests\Feature;

use App\Models\Country;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CountryTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/country', [
            'name' => fake()->name(),
            'status' => 1,
        ]);

        // show the error
        // dd($response->getContent());

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $country = Country::first();
        $response = $this->put('/country/' . $country->slug, [
            // 'name' => fake(),
            'status' => 0
        ]);

        $response->assertStatus(201);
    }

    public function test_delete(): void
    {
        $country = Country::first();
        $response = $this->delete('/country/' . $country->slug);

        $response->assertStatus(201);
    }
}
