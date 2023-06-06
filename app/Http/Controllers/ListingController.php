<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeOfTransaction;
use App\Models\Category;

class ListingController extends Controller
{
    public function showMarketplacePage()
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {

            $typeOfTransactions = TypeOfTransaction::all();
            $categories = Category::all();
            return view('pages.marketplace', compact('typeOfTransactions', 'categories'));
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
    
}
