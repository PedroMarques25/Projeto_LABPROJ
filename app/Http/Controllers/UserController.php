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
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|same:password',
        ]);

        // Create a new user object
        $user = User::create($validatedData);
        $user->save();


        return Redirect::back()->with('success', 'User created successfully');
    }

    public function login (Request $request){
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // Store the user's name in the session
            session(['user_name' => $user->name]);

            //Store the user's bio in the session
            session(['user_bio' => $user->bio]);

            // Authentication successful, redirect to a dashboard or profile page
            return redirect()->intended('/profile');
        }

        // Authentication failed, redirect back with an error message
        return redirect()->back()->withInput()->withErrors(['login' => 'Invalid credentials']);
    }
    public static function logout(Request $request = null)
    {
        Auth::logout();
        /*$request->session()->invalidate();
        $request->session()->regenerateToken(); // Regenerate the CSRF token*/

        $request->session()->forget('user_name');
        $request->session()->forget('user_bio');

        return redirect('index');
    }
}


