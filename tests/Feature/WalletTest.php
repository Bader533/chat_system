<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WalletTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/wallet', [
            'user_id' => 1,
            'type' => 'gold',
            'quantity' => 100,
        ]);

        $response->assertStatus(201);
    }

    // public function test_update(): void
    // {
    //     $response = $this->post('/wallet', [
    //         'id' => 1,
    //         'type' => 'gold',
    //         'gold' => 100,
    //     ]);

    //     $response->assertStatus(201);
    // }
}
