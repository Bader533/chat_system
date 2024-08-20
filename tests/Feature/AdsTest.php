<?php

namespace Tests\Feature;

use App\Models\Ads;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class AdsTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_store(): void
    {
        for ($i = 1; $i < 20; $i++) {
            $response = $this->post('/ads', [
                'name' => fake()->name(),
                'description' => fake()->paragraph(),
                'status' => 1,
                'is_home' => 1,
                'avatar' => UploadedFile::fake()->image('avatar.jpg'),
            ]);
        }

        $response->assertStatus(201);
    }

    public function test_update(): void
    {
        $ads = Ads::first();
        $response = $this->put('/ads/' . $ads->slug, [
            'name' => fake()->name(),
            'description' => fake()->paragraph(),
            'status' => 1,
            'is_home' => 1,
            // 'avatar' => UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $response->assertStatus(201);
    }

    // public function test_delete(): void
    // {
    //     $ads = Ads::first();
    //     $response = $this->delete('/ads/' . $ads->slug);

    //     $response->assertStatus(201);
    // }
}
