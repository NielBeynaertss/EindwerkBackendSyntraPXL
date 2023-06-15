<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;


class SettingsController extends Controller
{
    public function showSettingsPage()
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {

            $members = Member::all();
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
    
        $member = Auth::guard('member')->user();
        $member->update([
            'profile_picture' => $imageName, // Save the image name in the 'profile_picture' column
        ]);
    
        // Redirect back to the current listing page
        return redirect()->back();
    }
    

}
