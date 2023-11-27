<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use function Laravel\Prompts\error;

class ProfileController extends Controller
{
    public function edit()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('edit-profile');
    }

    public function updateUserProfile(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

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

        //If any change was made
        if (!empty($updateFields)) {
            $user->fill($updateFields);
            $user->save();
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        }

        return redirect()->route('profile');
    }

    public function updateProfilePicture(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            // Set a unique name for the image file
            $imageName = $user->id . '_' . time() . '_profile.' . $image->getClientOriginalExtension();

            $image->storeAs('storage/app/public', $imageName, 'public');

                // Update the image path
                $user->image_path = '/storage/app/public' . $imageName;
                $user->save();
                return redirect()->route('profile')->with('success', 'Profile picture updated successfully');
            } else {
                // If the file doesn't exist, something might be wrong with the upload process
                return redirect()->route('profile')->with('error', 'Failed to upload the image');
            }
    }

    public function deleteProfile(Request $request)
    {
        // If the user is not logged in, redirect to the login page
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if the provided password matches the authenticated user's password
        if (Hash::check($request->password, $user->password)) {
            // Password matches, delete the user
            $user->delete();
            return redirect()->route('home')->with('success', 'Account deleted successfully.');
        } else {
            // Password does not match, redirect back with an error message
            return redirect()->back()->with('error', 'Incorrect password. Account deletion failed.');
        }
    }
}
