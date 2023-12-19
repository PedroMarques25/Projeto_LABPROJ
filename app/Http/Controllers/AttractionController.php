<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Authenticate;
use App\Models\Attraction;
use App\Models\City;
use App\Models\Type;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AttractionController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }

    public function store(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {

        $cities = City::all();
        $types = Type::all();

        return view('add_new_attraction', [
            'cities' => $cities,
            'types' => $types,
        ]);
    }

    protected function creation(Request $request){

        $validatedData = $request->validate([
            'name' => 'required|profanity|string',
            'type_id' => 'required|integer',
            'city_id' => 'required|integer',
            'aboutIt' => 'required|profanity|string',
            'price' => 'required|numeric|gte:0',
            'attraction_image_path' => 'image|nullable',
            'creation_date' => Carbon::now()
        ]);

        $newAttraction = (new Attraction)->create($validatedData);

        if($newAttraction->save()){
            return redirect()->route('show.profile')->with('success', 'Attraction added');
        }
        return redirect()->back()->withInput();
    }
}
