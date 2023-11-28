<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;

class PurchaseController extends Controller{
    public function my_cart()
    {
        if (!Auth::check()) {

            return redirect()->route('login');
        }
        return view ('my_cart');
    }
}
