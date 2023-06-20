<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class SettingsController extends Controller
{
    public function showSettingsPage()
    {
        $user = Auth::user();

        if ($user && $user->approved) {

            $users = User::all();
            return view('auth.settings');
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
    public function updateProfilePicture(Request $request)
    {
        $request->validate([
            'profile_picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rule for the picture field
        ]);
    
        $imageName = null;
    
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('profile-images'), $imageName);
        }
    
        $member = Auth::user();
        $member->update([
            'profile_picture' => $imageName, // Save the image name in the 'profile_picture' column
        ]);
    
        // Redirect back to the current listing page
        return redirect()->back();
    }
    public function updateCredentials(Request $request)
    {
        $user = Auth::user();
        $updatedFields = $request->except('_token');
    
        foreach ($updatedFields as $field => $value) {
            if ($user->{$field} !== $value) {
                $user->{$field} = $value;
            }
        }
    
        $user->update();
    
        // Redirect back to the settings page or any other desired location
        return redirect()->back();
    }
    public function updatePassword(Request $request)
    {
        $validatedData = $request->validate([
            'password' => 'required|min:8|confirmed',
        ]);
    
        $password = $validatedData['password'];
    
        $user = Auth::user();
        $user->update([
            'password' => Hash::make($password),
        ]);
    
        // Redirect back to the settings page or any other desired location
        return redirect()->back();
    }
    
    
    
    

}
