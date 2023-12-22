<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Administrator;
use App\Http\Middleware\Authenticate;
use App\Models\Attraction;
use App\Models\City;
use App\Models\Country;
use App\Models\Guide;
use App\Models\Route;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class, Administrator::class]);
    }
    protected function admin_index_page(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $topGuides = Guide::orderBy('rating', 'desc')->take(5)->get();
        $topRoutes = Route::orderBy('rating', 'desc')->take(5)->get();
        $userNumber = User::count();
        $guideNumber = Guide::count();
        $routesNumber = Route::count();
        $countriesNumber = Country::count();
        $imagePath = Auth::user()->image_path;


        return view('admin.admin', [
            'topGuides' => $topGuides,
            'topRoutes' => $topRoutes,
            'userNumber'=> $userNumber,
            'guideNumber'=> $guideNumber,
            'routesNumber'=>$routesNumber,
            'countriesNumber'=>$countriesNumber,
            'imagePath'=>$imagePath
        ]);
    }

    protected function admin_all_routes(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $routes = Route::all();

        return view('admin.all_routes_admin_page', [
            'routes'=>$routes,
        ]);
    }

    protected function admin_all_users(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $users = User::all();

        foreach ($users as $user) {
            $hasGuide = Guide::where('user_id', $user->id)->exists();
            $user->hasGuide = $hasGuide;
        }

        return view('admin.all_users_admin_page', [
            'users'=>$users,
        ]);
    }

    protected function admin_all_guides(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $guides = Guide::all();

        return view('admin.all_guides_admin_page', [
            'guides'=>$guides,
        ]);
    }

    protected function admin_all_attractions(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $attractions = Attraction::all();

        foreach ($attractions as $attraction) {
            $hasRoute =  $attraction->routes = $attraction->routes()->distinct()->get();
            $attraction->hasRoute = $hasRoute;
        }

        return view('admin.all_attractions_admin_page', [
            'attractions'=>$attractions,
        ]);
    }

    protected function admin_charts(): \Illuminate\Contracts\View\View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $userNumber = User::count();
        $guideNumber = Guide::count();
        $routesNumber = Route::count();
        $countriesNumber = Country::count();

        return view('admin.charts_admin_page', [
            'userNumber' => $userNumber,
            'guideNumber' => $guideNumber,
            'routesNumber' => $routesNumber,
            'countriesNumber' => $countriesNumber
        ]);
    }
}
