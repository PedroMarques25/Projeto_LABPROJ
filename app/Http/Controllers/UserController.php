<?php

namespace App\Http\Controllers;

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
                // Regular expression to disallow spaces and encoded characters
                'regex:/^[^\s]+$|^[^\p{C}]+$/u',
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Email format validation
                'regex:/^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Z|a-z]{2,}$/',
                'unique:users',
            ],
            'password' => 'required|string|min:8|confirmed', // "confirmed" rule
            'password_confirmation' => 'required|string|min:8',
        ]);

        // Create a new user object
        $user = User::create($validatedData);
        $user->save();

        // Optionally, return a response or redirect somewhere
        return Redirect::back()->with('success', 'User created successfully');
    }

    public function login (Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {
            // Authentication successful, redirect to a dashboard or profile page
            return redirect()->intended('/profile');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
    }
}
