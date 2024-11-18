<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Http\Request;



class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(), // Pass the authenticated user to the view
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        // Get the authenticated user
        $user = $request->user();
    
        // Handle profile photo upload if there is one
        if ($request->hasFile('photo')) {
            // Validate the uploaded file
            $request->validate([
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
    
            // Delete the old profile photo if it exists
            if ($user->profile_photo_path && Storage::exists($user->profile_photo_path)) {
                Storage::delete($user->profile_photo_path);
            }
    
            // Store the new profile photo
            $user->profile_photo_path = $request->file('photo')->store('profile_photos', 'public');
        }
    
        // Update the user's name and email
        $user->fill($request->validated());
    
        // If the email is changed, mark the email as unverified
        if ($request->user()->isDirty('email')) {
            $user->email_verified_at = null;
        }
    
        // Save the updated user details
        $user->save();
    
        // Redirect to the edit profile page with a success message
        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        // Validate the password before deleting the user
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        // Get the authenticated user
        $user = $request->user();

        // Log out the user and delete their account
        Auth::logout();
        $user->delete();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the home page
        return Redirect::to('/');
    }
}
