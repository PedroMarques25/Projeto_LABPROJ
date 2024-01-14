<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Route;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;

class PurchaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function my_cart()
    {
        return view('my_cart');
    }

    public function increaseQuantity(Request $request): RedirectResponse
{
    $currentQuantity = session('cart_quantity', 0);
    $newQuantity = $currentQuantity * 2;
    $selectedTime = $request->input('selected_time');


    session(['cart_quantity' => $newQuantity]);
    

    return redirect()->back()->with('success', 'Quantity increased');
}

public function decreaseQuantity(Request $request): RedirectResponse
{
    $currentQuantity = session('cart_quantity', 0);
    $newQuantity = max($currentQuantity / 2, 1); // Ensure quantity doesn't go below 1
    $selectedTime = $request->input('selected_time');

    // Handle the selected time as needed

    session(['cart_quantity' => $newQuantity]);

    return redirect()->back()->with('success', 'Quantity decreased');
}


    public function addToCart($routeId)
    {
        $route = Route::findOrFail($routeId);

        if ($route->remaining_available_slots <= 0) {
            return redirect()->back()->with('error', 'This route has no available slots.');
        }

        $cart = session()->get('cart', []);

        if (!in_array($routeId, $cart)) {
            $cart[] = $routeId;
            session()->put('cart', $cart);

            return redirect()->route('my-cart');
        }
    }

    public function removeFromCart($routeId)
    {
        $cart = session()->get('cart', []);

        if (($key = array_search($routeId, $cart)) !== false) {
            unset($cart[$key]);
            session()->put('cart', $cart);
            return redirect()->route('my-cart')->with('success', 'Route removed from cart.');
        } else {
            return redirect()->route('my-cart')->with('error', 'Route not found in cart.');
        }
    }

    public function viewCart(): View
    {
        $cart = session()->get('cart', []);
        $routesInCart = Route::whereIn('id', $cart)->get();
        return view('my_cart', compact('routesInCart'));
    }
}
