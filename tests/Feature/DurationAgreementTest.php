<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DurationAgreementTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store_update(): void
    {
        $response = $this->post('/duration-agreement', [
            'title' => fake()->title(),
            'description' => fake()->paragraph(),
        ]);

        $response->assertStatus(201);
    }
}
