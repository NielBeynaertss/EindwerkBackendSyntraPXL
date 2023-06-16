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

    public function updateCredentials($id)
    {
        if ($id === 'lastname') {    
            // Retrieve the submitted form data
            $lastname = request('lastname');

            $member = Auth::user();
            $member->update([
                'lastname' => $lastname
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'firstname') {    
            // Retrieve the submitted form data
            $firstname = request('firstname');

            $member = Auth::user();
            $member->update([
                'firstname' => $firstname
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'email') {    
            // Retrieve the submitted form data
            $email = request('email');

            $member = Auth::user();
            $member->update([
                'email' => $email
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'phone') {    
            // Retrieve the submitted form data
            $phone = request('phone');

            $member = Auth::user();
            $member->update([
                'phone' => $phone
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'streetnr') {    
            // Retrieve the submitted form data
            $streetnr = request('streetnr');

            $member = Auth::user();
            $member->update([
                'streetnr' => $streetnr
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'city') {    
            // Retrieve the submitted form data
            $city = request('city');

            $member = Auth::user();
            $member->update([
                'city' => $city
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        if ($id === 'password') {    
            // Retrieve the submitted form data
            $password = request('password');

            $member = Auth::user();
            $member->update([
                'password' => Hash::make($password),
            ]);

            // Redirect back to the settings page or any other desired location
            return redirect()->back();
        }
        // If no matching ID is found, return a redirect or error message
        return redirect()->back()->with('error', 'Invalid ID.');
    }
    
    

}
