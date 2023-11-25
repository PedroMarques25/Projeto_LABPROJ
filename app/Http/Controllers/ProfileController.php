<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('edit-profile');
    }

    public function updateBio(Request $request)
    {
        $user = Auth::user();

        // Validate the submitted data if needed
        $request->validate([
            'bio' => 'required|string',
        ]);

        // Update the user's bio
        $user->bio = $request->input('bio');
        $user->save();

        // Store the updated bio in the session
        session(['user_bio' => $user->bio]);

        return redirect()->route('profile')->with('success', 'Bio updated successfully');
    }

    public function updateUserProfile(Request $request)
    {
        $user = Auth::user();

        $updateFields = [];

        if (!empty($request->input('bio'))) {
            $updateFields['bio'] = $request->input('bio');

            //Update bio
            $user->bio = $request->input('bio');
            session(['user_bio' => $user->bio]);
        }

        if (!empty($request->input('name_edit'))) {
            $updateFields['name'] = $request->input('name_edit');

            //Update name
            $user->name = $request->input('name_edit');
            session(['user_name' => $user->name]);
        }

        if (!empty($request->input('city_edit'))) {
            $updateFields['city'] = $request->input('city_edit');
        }

        if (!empty($request->input('password_edit'))) {
            $updateFields['password'] = bcrypt($request->input('password_edit'));
        }

        $user->fill($updateFields);
        $user->save();

        return redirect()->route('profile')->with('success', 'Profile updated successfully');
    }
}
