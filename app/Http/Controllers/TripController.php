<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Administrator;
use App\Http\Middleware\Authenticate;
use App\Models\Guide;
use App\Models\Route;
use App\Models\Trip;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TripController extends Controller
{
    public function __construct()
    {
        $this->middleware([Authenticate::class]);
    }

    public function show(){
        $myTrips = Trip::all();

        foreach ($myTrips as $trip) {
            $guideId = $trip->guide_id;
            $guide = Guide::find($guideId);
            $route = Route::find($trip->route_id);
            $routeName = $route->name;
            $user_id = $trip->user_id;

            if ($guide) {
                $userId = $guide->user_id;
                $user = User::find($userId);

                if ($user && $user_id === Auth::user()->id) {
                    $trip->guide_name = $user->name;
                    $trip->routeName = $routeName;
                    $filteredTrips[] = $trip; // Store the matched trip
                }
            }
        }
        //return view('myTrips.trips', ['myTrips' => $filteredTrips ?? []]); // Return the filtered trips
        return view('/profile');
    }


}
