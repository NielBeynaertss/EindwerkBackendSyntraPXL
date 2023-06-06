<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ListingController extends Controller
{
    public function showMarketplacePage()
    {
        if(Auth::guard('member')->check())
        {
            return view('pages.marketplace');
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    }

    
}
