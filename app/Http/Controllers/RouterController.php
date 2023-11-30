<?php

namespace App\Http\Controllers;

use App\Models\Route;

class RouterController extends Controller
{
    public function show($id)
    {
        $route = Route::findOrFail($id); // Fetch the route details based on ID
        return view('route_details', compact('route')); // Display detailed route information in the 'routes.show' view
    }
}
