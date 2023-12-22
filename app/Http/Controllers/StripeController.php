<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');

    }

    /**
     * @throws ApiErrorException
     */
    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $totalPrice = session('total_price');
        $quantity = session('cart_quantity');
        $quantity = (int)$quantity;
        $session = Session::create([
            'line_items'    => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name'=> 'Your next trip',
                        ],
                        'unit_amount' => (float)$totalPrice * 100
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode'  =>  'payment',
            'success_url' => route('success'),
            'cancel_url'    => route('index'),
        ]);
        return redirect() ->away($session->url);
    }

    public function success()
    {
        invoice();
        return redirect()->intended('/profile');

    }
}
