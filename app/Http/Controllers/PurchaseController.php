<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use function Laravel\Prompts\error;

class PurchaseController extends Controller{

    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
    public function my_cart()
    {
        return view ('my_cart');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function addToCart($routeId)
    {
        $cart = session()->get('cart', []);

        if (!in_array($routeId, $cart)) {
            $cart[] = $routeId;
            session()->put('cart', $cart);
        }

        return redirect()->back()->with('success', 'Route added to cart.');
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function viewCart()
    {
        $cart = session()->get('cart', []);

        $routesInCart = Route::whereIn('id', $cart)->get();
        return view('my_cart', compact('routesInCart'));
    }
}
