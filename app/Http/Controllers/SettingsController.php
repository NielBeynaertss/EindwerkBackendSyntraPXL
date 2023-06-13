<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Member;


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

    public function editCredential($id)
    {
        switch ($id) {
            case 'lastname':
                // Functionality for editing lastname
                break;
            case 'firstname':
                // Functionality for editing firstname
                break;
            case 'email':
                // Functionality for editing email
                break;
            case 'phone':
                // Functionality for editing lastname
                break;
            case 'streetnr':
                // Functionality for editing firstname
                break;
            case 'city':
                // Functionality for editing email
                break;
            case 'password':
                // Functionality for editing email
                break;
            
        }

    }

}
