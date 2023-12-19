<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Guide;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\s]+$|^[^\p{C}]+$/u',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$/',
                'unique:users',
            ],
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
            'city_id' => 'required|exists:cities,id',
        ]);

        // Create a new user object and save it to the database
        $user = User::create($validatedData);

        $user->city()->associate($validatedData['city_id']);
        $user->save();

        return Redirect::route('login')->with('success', 'User created successfully. Please log in.');
    }

    public function profile()
    {
        if (!(Auth::check()))
        {
            return redirect()->route('login');
        }

        return view('profile');
    }

    public function login (Request $request){

        if (Auth::check()) {
            return redirect('/profile');
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            session(['user_name' => $user->name]);

            session(['user_bio' => $user->bio]);

            $userCity = $user->city->name;

            session(['user_city' => $userCity]);

            return redirect()->intended('/profile');

        }
        // Authentication failed, redirect back with an error message
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
    }
    public static function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            session()->flush();
        }

        return redirect('index');
    }

}


