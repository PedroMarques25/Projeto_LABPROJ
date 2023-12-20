<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\Guide;
use App\Models\Route;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DisplayRoutesAndAttractionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    protected function showProfile(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $countries = Country::all();
        $user = Auth::user();
        if (Auth::user()->isGuide()) {
            $userId = Auth::id();
            $guide = Guide::where('user_id', $userId)->firstOrFail();
            $routes_guide = Route::where('guide_id', $guide->id)->get();
            $routes = Route::where('guide_id', '!=', $guide->id)->orderBy('created_at', 'desc')->get();
            $languages = $guide->languages()->get();
            return view('profile', compact('countries', 'routes', 'languages', 'user', 'routes_guide', 'guide'));
        } else {
            $routes = Route::orderBy('created_at', 'desc')->get();
            $attractions = Attraction::orderBy('creation_date', 'desc')->limit(5)->get();
            return view('profile', compact('attractions', 'countries', 'routes'));
        }
    }

    protected function searchRoutes(Request $request): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $attractions = Attraction::all();
        $cities = City::all();
        $guides = Guide::all();
        $searchResult = [];

        $searchFields = $request->validate([
            'dateToSearch' => 'date',
            'guideName' => 'string|max:255',
            'cityToSearch_id' => 'int',
            'ratingToSearch' => 'nullable|numeric|between:0,5',
        ], [
            'ratingToSearch.numeric' => 'Rating must be a number.',
            'ratingToSearch.between' => 'Rating must be a positive number not greater than 5.',
        ]);

        if(!empty($searchFields['dateToSearch'])){
            $route_date = $request->input('dateToSearch');
            $searchResult = Route::where('route_date', $route_date)->get();
        }

        if (!empty($searchFields['guideName'])) {
           $guideId = $request->input('guideName');
           $searchResult = Route::where('guide_id', $guideId)->get();
        }

        if(!empty($searchFields['cityToSearch_id'])){
            $city_id = $request->input('cityToSearch_id');
            $searchResult = Route::whereHas('attractions', function ($query) use ($city_id) {
                $query->whereHas('city', function ($innerQuery) use ($city_id) {
                    $innerQuery->where('id', $city_id);
                });
            })->get();
        }

        if(!empty($searchFields['ratingToSearch'])){
            $rating = $request->input('ratingToSearch');
            $searchResult = Route::where('rating', '>=', $rating)->get();
        }
        return view('search_route', compact('attractions', 'cities', 'guides', 'searchResult'));
    }
}
