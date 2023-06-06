<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingsController extends Controller
{
    public function showSettingsPage()
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {
            return view('auth.settings');
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
}
