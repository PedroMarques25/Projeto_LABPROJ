<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
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

    public function login()
    {
        if (Auth::check()) {
            return redirect()->route('profile');
        }
        return view ('login');
    }

    public function signin()
    {
        if (Auth::check()) {

            return redirect()->route('profile');
        }

        $cities = City::all();

        return view('signin', compact('cities'));
    }

    public function contact()
    {
        return view ('contact');
    }

    public function profile()
    {
        if (!(Auth::check())) {
            return redirect()->route('login');
        }
        return view ('profile');
    }

}
