<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use app\Models\Member;

class EventController extends Controller
{
    public function showEventsPage()
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {

            $members = Member::all();
            return view('pages.events');
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
}
