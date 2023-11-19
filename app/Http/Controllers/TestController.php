<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view ('login');
    }

    public function signin()
    {
        return view ('signin');
    }
}
