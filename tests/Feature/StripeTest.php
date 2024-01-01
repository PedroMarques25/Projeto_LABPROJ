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
use Database\Factories\UserFactory;

class StripeTest extends TestCase
{
    //use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testStripeControllerRouteAccess()
    {     
        $route = route('checkout');

        $response = $this->get($route);

        // status code 200 = sucesso
        $response->assertStatus(200);

    }
}
