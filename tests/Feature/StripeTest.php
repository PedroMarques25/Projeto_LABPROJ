<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Database\Factories\UserFactory;

class StripeTest extends TestCase
{
    //use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testStripeControllerRouteAccess()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $route = route('checkout');

        $response = $this->get($route);

        $response->assertStatus(200);

    }
}
