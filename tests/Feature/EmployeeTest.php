<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        $response = $this->post('/employee', [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'type' => 1,
            'status' => 1,
            'password' => '123456',
            'password_confirmation' => '123456',
        ]);
        // dd($response->getContent());
        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $employee = User::first();
        $response = $this->put('/employee/' . $employee->id, [
            'name' => fake()->name(),
            'email' => fake()->email(),
            'status' => null,
            'type' => null,
            'password' => null,
            'password_confirmation' => null,
        ]);
        $response->assertStatus(201);
    }

    // public function test_delete(): void
    // {
    //     $room = GlaEvent::first();
    //     $response = $this->delete('/gla-event/' . $room->slug);
    //     $response->assertStatus(201);
    // }
}
