<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Attraction;
use App\Models\Route;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RouterController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
    public function show($id): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        $route = Route::findOrFail($id); // Fetch the route details based on ID
        return view('route_details', compact('route')); // Display detailed route information in the 'routes.show' view
    }

    public function store(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $attractions = Attraction::all(); // Fetch all attractions from the Attractions table

        return view('add_new_route', ['attractions' => $attractions]);
    }

    public function creation(Request $request): RedirectResponse
    {

        $request->validate([
            'name' => 'required',
            'total_slots' => 'required|numeric|min:1|max:100',
            'aboutIt' => 'required|profanity|max:255',
            'route_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'attractions' => 'array',
            'fee' => 'required|numeric|between:0,20',
            'route_date' => 'required|date|after_or_equal:today',
        ]);

        $imagePath = "storage/route-default-image.jpg"; // Default image path if no image is uploaded

        if ($request->hasFile('route_image')) {
            $imagePath = $request->file('route_image')->store('route_images');
        }

        $user = Auth::user();

        $route = (new Route)->create([
            'created_at' => now(),
            'updated_at' => now(),
            'name' => $request->input('name'),
            'route_image_path' => $imagePath,
            'guide_id' => $user->guide->id,
            'creation_date' => now(),
            'rating' => 0,
            'total_slots' => $request->input('total_slots'),
            'remaining_available_slots' => $request->input('total_slots'), // Initially all slots are available
            'aboutIt' => $request->input('aboutIt'),
            'fee' => $request->input('fee'),
            'route_date' => $request->input('route_date'),
            'total_price' => 0,
            'duration' => $request->input('duration')
        ]);

        if ($request->has('attractions')) {
            $route->attractions()->attach($request->input('attractions'));
        }

        if ($route->save()) {
            $totalPrice = $route->calculateTotalPrice();
            $route->update(['total_price' => $totalPrice]);

            return redirect()->route('show.profile')->with('success', 'Route added');
        }
        return redirect()->back()->withInput();
    }

    public function deleteRoute($routeID)
    {

        $route = Route::find($routeID);

        if ($route->delete()) {
            return redirect()->action([DisplayRoutesAndAttractionsController::class, 'showProfile'])->with('success', 'Route deleted successfully.');
        } else {
            return redirect()->route('show.profile')->with('error', 'Failed to delete the route.');
        }
    }

}
