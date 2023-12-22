<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\City;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller

{
    public function home()
    {
        return view ('index');
    }

    public function about()
    {
        return view ('about');
    }

    public function index()
    {
        return view ('index');
    }

    public function contact()
    {
        return view ('contact');
    }

    public function signin()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }

        $cities = City::all();

        return view('signin', compact('cities'));
    }

    public function login()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }

        return view('login');
    }
}
