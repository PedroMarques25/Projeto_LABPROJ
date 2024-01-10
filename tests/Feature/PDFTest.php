<?php

namespace Tests\Feature;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Models\User;

class PDFTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testPDFGeneration()
    {
        $user = User::factory()->create();

        $this->actingAs($user);
        
        $route = route('generate-pdf');

        $response = $this->get($route);

        $response->assertStatus(405);

    }
}
