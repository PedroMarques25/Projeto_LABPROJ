<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class MyCartTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function MyCartAccess(): void
    {
       $user = User::factory()->create();

        $this->actingAs($user);

        $response = $this->get('/my-cart');

        $response->assertStatus(200);
    }
}
