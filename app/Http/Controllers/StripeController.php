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
        $cartQuantity = session('cart_quantity', 1);

        $session = Session::create([
            'line_items'    => [
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name'=> 'Your next trip',
                        ],
                        'unit_amount' => (float)$totalPrice * 100 * $cartQuantity
                    ],
                    'quantity' => $cartQuantity,
                ],
            ],
            'mode'  =>  'payment',
            'success_url' => route('success'),
            'cancel_url'    => route('index'),
        ]);
        return redirect() ->away($session->url);
    }

    public function success(): RedirectResponse
    {
        $invoiceId = invoice();
        confirmPurchase($invoiceId);
        decreaseAvailableSlots();
        return redirect()->intended('/my-trips');
    }
}
