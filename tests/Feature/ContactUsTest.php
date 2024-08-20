<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ContactUsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->post('/api/contact', [
            'message' => fake()->title(),
            'subject' => fake()->title,
            'email' => fake()->email(),
            'f_name' => fake()->name(),
            'l_name' => fake()->name
        ]);

        $response->assertStatus(201);
    }
}
