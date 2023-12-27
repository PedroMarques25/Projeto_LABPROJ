<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;
use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class StripeTest extends TestCase
{
    //use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testStripeControllerRouteAccess()
    {
        $user = factory(User::class)->create();

        Auth::login($user);
        
        $route = route('checkout');

        $response = $this->get($route);

        // status code 200 = sucesso
        $response->assertStatus(200);

    }
}
