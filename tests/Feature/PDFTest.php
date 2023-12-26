<?php

namespace Tests\Feature;

use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;

class PDFTest extends TestCase
{
    use RefreshDatabase, WithFaker, WithoutMiddleware;

    public function testPDFGeneration()
    {
        // Make a GET request to the route that triggers PDF generation
        $response = $this->get(route('generatePDF'));

        // Assert that the response is successful (status code 200)
        $response->assertStatus(200);

        // Assert that the response has a PDF header
        $response->assertHeader('Content-Type', 'application/pdf');

        // You may want to further assert the PDF content or structure, depending on your requirements
        // For example, you can use the PDF facade from barryvdh/laravel-dompdf to inspect the content
        $pdf = PDF::load($response->stream());
        $textInPdf = $pdf->getText(); // Adjust this based on your actual PDF content

        // Add more assertions as needed based on the PDF content
        // For example, you might want to assert that certain text is present in the PDF
        $this->assertStringContainsString('Welcome to ThisIsMyCity.com', $textInPdf);
    }
}
