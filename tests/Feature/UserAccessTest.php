<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserAccessTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function a_logged_in_user_can_access_certain_route()
    {
        
        $user = new User;

        $user->name('Kelvin Druant');
        
        $this->actingAs($user);

        $route = route('/my-cart');

        $response = $this->get($route);
       
        $response->assertStatus(200);
    }
}
