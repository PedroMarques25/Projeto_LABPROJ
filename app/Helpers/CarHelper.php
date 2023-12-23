<?php

use App\Models\Route;
use App\Models\Trip;

if (!function_exists('carContent')) {
    function carContent(): array
    {
        $cart = session()->get('cart', []);
        $routesInCart = Route::whereIn('id', $cart)->get();
        $routeDetailsArray = [];

        foreach ($routesInCart as $route) {
            $routeDetails = [
                'id' => $route->id,
                'name' => $route->name,
                'about' => $route->aboutIt,
                'total_price' => $route->tota_price,
                'guide_id' => $route->guide_id,
                'duration' => $route->duration,
            ];

            $attractions = $route->attractions()->pluck('name')->toArray();
            $routeDetails['attractions'] = implode(', ', $attractions);

            $routeDetailsArray[] = $routeDetails;

        }

        return [
            'title' => 'This is my city',
            'title_' => 'Invoice',
            'date' => date('m/d/Y'),
            'user_name' => Auth::user()->name,
            'routeDetails' => $routeDetailsArray,
        ];
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



if (!function_exists('confirmPurchase')) {
    function confirmPurchase($invoiceId): void
    {
        $user = Auth::user();

        $data = carContent(); // Get route details from carContent

        foreach ($data['routeDetails'] as $route) {
            $routeModel = Route::where('id', $route['id'])->first(); // Fetch the Route model
            if ($routeModel) { // Check if the Route exists
                $trip = new Trip([
                    'date_of_purchase' => now(),
                    'user_id' => $user->id,
                    'guide_id' => $routeModel->guide_id,
                    'route_id' => $routeModel->id,
                    'invoice_id' => $invoiceId,
                ]);
                $trip->save();
            }
        }
    }
}
