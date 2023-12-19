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

    protected function searchRoutes(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $attractions = Attraction::all();
        $cities = City::all();
        $guides = Guide::all();
        return view('search_route', compact('attractions', 'cities', 'guides'));
    }

    protected function searchResult(Request $request){
        dd($request);
        $searchResult = [];

        //      Search by date
        /*if(!empty($request->input('dateToSearch'))){
            $route_date = $request->input('dateToSearch');
            $searchResult = Route::where('route_date', $route_date)->get();
        }*/

        //      Search by guide name
        if(!empty($request->input('guideName'))){
            $guideName = $request->input('guideName');
            $user = User::where('name', $guideName)->get();
            $guide = Guide::where('user_id', $guideName)->value('id');
            //$guideID = Guide::where('user_id', $userId)->value('id');
           // $searchResult = Route::where('guide_id', $guide->id)->get();
        }

        return view('search_route_result', compact('searchResult'));
    }

}
