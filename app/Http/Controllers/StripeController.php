<?php

namespace App\Http\Controllers;

use Stripe\Checkout\Session;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function index()
    {
        return view('index');

    }

    public function checkout()
    {
        Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
        $totalPrice = session('total_price');
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
        return view('index');
    }
}
