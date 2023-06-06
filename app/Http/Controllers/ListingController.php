<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeOfTransaction;
use App\Models\Category;
use App\Models\Listing;


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

    
    public function storeListing(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:250',
            'location' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'category' => 'required',
            'typeOfTransaction' => 'required',
        ]);

        Listing::create([
            'title' => $request->title,
            'location' => $request->location,
            'description' => $request->description,
            'category_id' => $request->category,
            'type_of_transaction_id' => $request->typeOfTransaction,
        ]);


        return view('welcome');
    }
}
