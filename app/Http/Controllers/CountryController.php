<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Country;

class CountryController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact($countries));
    }
}
