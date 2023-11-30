<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Guide;
use App\Models\Language;
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
            session(['user_city' => $user->name]);
        }

        $newPassword = $request->input('password_edit');
        $currentPassword = $request->input('password_confirmation_edit');

        if (!empty($currentPassword) && Hash::check($currentPassword, $user->password) && !empty($newPassword)) {

            $validatedData = $request->validate([
                'password_edit' => 'required|string|min:8',
            ]);

            if($validatedData){
                $updateFields['password'] = bcrypt($newPassword);

            }
        }
        //If any change was made
        if (!empty($updateFields)) {
            $user->fill($updateFields);
            $user->save();
            return redirect()->route('profile')->with('success', 'Profile updated successfully');
        }

        return redirect()->back()->with('error', 'Something went wrong');
    }

    public function updateProfilePicture(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]); /**/

        if ($request->file('profile_image')) {
            $user = Auth::user();

            $image = $request->file('profile_image');

            // Set a unique name for the image file
            $imageName = $user->id . '_' . time() . '_profile.' . $image->getClientOriginalExtension();

            // Store the image in the storage folder using the 'public' disk
            $image->storeAs('public', $imageName);

            // Update the image path in the database
            $user->image_path = 'storage/' . $imageName;
            $user->save();

            return redirect()->route('profile')->with('success', 'Profile picture updated successfully');
        } //else {
        // If the file doesn't exist, something might be wrong with the upload process
        return redirect()->route('profile')->with('error', 'Failed to upload the image');
        //}
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

    protected function becameAGuide()
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $languages = Language::all();

        return view('become_guide', ['languages' => $languages]);
    }

    protected function createGuide(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $user = Auth::user();

        // Check if the user already has a guide
        $existingGuide = Guide::where('user_id', $user->id)->exists();

        if ($existingGuide) {
            return redirect()->route('become-guide')->with('error', 'User already registered as a guide');
        }

        $selectedLanguages = $request->input('languages');

        $languages = Language::whereIn('id', $selectedLanguages)->get();

        // Create a new guide
        $guide = new Guide();
        $guide->user_id = $user->id;

        if ($guide->save()) {
            $guide->languages()->attach($languages);

            // Success message
            return redirect()->route('become-guide')->with('success', 'Guide created successfully!');
        } else {
            // Error message if guide creation fails
            return redirect()->back()->with('error', 'Failed to create guide. Please try again.');
        }
    }


}
