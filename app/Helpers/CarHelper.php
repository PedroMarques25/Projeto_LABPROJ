<?php

use App\Models\Route;

if (!function_exists('carContent')) {
    function carContent()
    {
        $cart = session()->get('cart', []);
        $routesInCart = Route::whereIn('id', $cart)->get();
        $routeDetailsArray = [];

        foreach ($routesInCart as $route) {
            $routeDetails = [
                'name' => $route->name,
                'about'=> $route->aboutIt,
                'total_price' => $route->tota_price,
                'duration' => $route->duration,
            ];

            $attractions = $route->attractions()->pluck('name')->toArray();
            $routeDetails['attractions'] = implode(', ', $attractions);

            $routeDetailsArray[] = $routeDetails;

        }

        $data = [
            'title' => 'This is my city',
            'title_' => 'Invoice',
            'date' => date('m/d/Y'),
            'user_name' => Auth::user()->name,
            'routeDetails' => $routeDetailsArray,
        ];

        return $data;
    }
}

if (!function_exists('decreaseAvailableSlots')) {
    function decreaseAvailableSlots(): void
    {

        $data = carContent(); // Get route details from carContent

        foreach ($data['routeDetails'] as $route) {
            $routeModel = Route::where('name', $route['name'])->first(); // Fetch the route from the database
            $routeModel->remaining_available_slots -= 1;
            $routeModel->save();
        }

        session()->forget('cart');
    }
}
