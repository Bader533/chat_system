<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LevelTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_create_level_successfully()
    {
        $data = [
            'name_en' => 'Level 1',
            'name_ar' => 'المستوى 1',
            'description_en' => 'Description in English',
            'description_ar' => 'الوصف بالعربية',
            'avatar' => 'avatar.png',
            'status' => 1,
            'diamonds' => 100,
            'gold' => 100,
            'silver' => 100,
        ];

        $response = $this->withoutMiddleware()->post('/level', $data);
        // dd($response->getContent());
        $response->assertStatus(201);
    }

    public function test_level_creation_fails_on_missing_name()
    {
        $data = [
            'description_en' => 'Description in English',
            'description_ar' => 'الوصف بالعربية',
        ];

        $response = $this->withoutMiddleware()->post('/level', $data);

        $response->assertStatus(302)
            ->assertJsonValidationErrors(['name_en', 'name_ar']);
    }
}
