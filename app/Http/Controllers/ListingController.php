<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Member;
use Illuminate\Support\Facades\Auth;
use App\Models\TypeOfTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Pagination\Paginator;


class ListingController extends Controller
{

    public function showMarketplacePage(Request $request)
    {
        $member = Auth::guard('member')->user();

        if ($member && $member->approved) {
            $categories = Category::all();
            $query = Listing::query();

            // Check if the 'alphabetical ascending' filter is selected
            if ($request->filter === 'ascending') {
                $query->orderBy('title', 'asc');
            }
            // Check if the 'alphabetical descending' filter is selected
            if ($request->filter === 'descending') {
                $query->orderBy('title', 'desc');
            }
            // Check if the 'only sell' filter is selected
            if ($request->filter === 'only_sell') {
                $query->where('type_of_transaction', 'sell');
            }
            // Check if the 'only loan' filter is selected
            if ($request->filter === 'only_loan') {
                $query->where('type_of_transaction', 'loan');
            }

            $listings = $query->paginate(6);

            Paginator::useBootstrap(); // Use Bootstrap styling for the pagination links

            return view('pages.marketplace', compact('categories', 'listings'));
        }

        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved');
    }
    public function clearFilters()
    {
        return redirect()->route('marketplace');
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
            'title' => strtoupper($request->title),
            'location' => $request->location,
            'description' => $request->description,
            'category' => $request->category,
            'type_of_transaction' => $request->typeOfTransaction,
        ]);


        // Redirect back to the current listing page
        return redirect()->back();
    }


    public function showListingDetails($id)
    {
        $listing = Listing::find($id);
        return view('pages.listing-detail', compact('listing'));
    }

    public function addToFavorites(Request $request)
    {
        $member = Auth::guard('member')->user();
        $listingId = $request->input('listingId');

        // Retrieve the member's current favorite listings
        $favoriteListings = $member->favourite_listings ? json_decode($member->favourite_listings, true) : [];

        // Convert the existing string value to an array if it's not already
        if (!is_array($favoriteListings)) {
            $favoriteListings = [$favoriteListings];
        }

        // Add or remove the listing ID from the favorites array based on its presence
        if (in_array($listingId, $favoriteListings)) {
            // Remove the listing ID from favorites
            $favoriteListings = array_diff($favoriteListings, [$listingId]);
        } else {
            // Add the listing ID to favorites
            $favoriteListings[] = $listingId;
        }

        // Update the member's favorite listings in the database
        $member->favourite_listings = json_encode($favoriteListings);
        $member->save();

        // Redirect back to the current listing page
        return redirect()->back();
    }

}
