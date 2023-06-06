<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    public function showMarketplacePage()
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {
            return view('pages.marketplace');
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }

    

    
}
