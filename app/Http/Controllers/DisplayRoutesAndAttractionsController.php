<?php

namespace App\Http\Controllers;

use App\Models\Attraction;
use App\Models\Country;
use App\Models\Guide;
use App\Models\Route;
use Illuminate\Support\Facades\Auth;

class DisplayRoutesAndAttractionsController extends Controller
{
    protected function showProfile()
    {
        $countries = Country::all();
        $user = Auth::user();
        if (Auth::user()->isGuide()) {
            $userId = Auth::id();
            $guide = Guide::where('user_id', $userId)->firstOrFail();
            $routes_guide = Route::where('guide_id', $guide->id)->get();
            $routes = Route::where('guide_id', '!=', $guide->id)->orderBy('created_at', 'desc')->get();
            $languages = $guide->languages()->get();
            return view('profile', compact('countries', 'routes', 'languages', 'user', 'routes_guide'));
        } else {
            $routes = Route::orderBy('created_at', 'desc')->get();
            $attractions = Attraction::orderBy('creation_date', 'desc')->limit(5)->get();
            return view('profile', compact('attractions', 'countries', 'routes'));
        }
    }
}
