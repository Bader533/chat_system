<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_register(): void
    {
        $response = $this->post('/api/auth/register', [
            'name' => fake()->name(),
            'email' => fake()->email(),
            // 'phone' => rand(1, 10000),
            'password' => '123456789',

        ]);

        $response->assertStatus(200);
    }
}
