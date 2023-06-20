<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\TypeOfTransaction;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\Listing;
use Illuminate\Pagination\Paginator;


class ListingController extends Controller
{
    public function showMarketplacePage(Request $request)
    {
        $user = Auth::user();

        if ($user && $user->approved) {
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
            'city' => 'required|string|max:250',
            'description' => 'required|string|max:250',
            'category' => 'required',
            'typeOfTransaction' => 'required',
            'postalcode' => 'required',
            'pictures' => 'required|array', // Add validation rule for the pictures field
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rule for each picture in the array
        ]);
    
        $pictures = [];
    
        if ($request->hasFile('pictures')) {
            foreach ($request->file('pictures') as $picture) {
                $pictureName = time() . '_' . $picture->getClientOriginalName();
                $picture->move(public_path('listing-images'), $pictureName);
                $pictures[] = $pictureName;
            }
        }
    
        Listing::create([
            'title' => strtoupper($request->title),
            'city' => $request->city,
            'description' => $request->description,
            'category' => $request->category,
            'type_of_transaction' => $request->typeOfTransaction,
            'created_by' => Auth::user()->lastname .' '. Auth::user()->firstname,
            'postalcode' => $request->postalcode,
            'pictures' => $pictures, // Save the array of picture names in the 'pictures' column
        ]);
    
        // Redirect back to the current listing page
        return redirect()->back();
    }
    public function showListingDetails($id)
    {
        $listing = Listing::find($id);
        return view('pages.listing-detail', compact('listing'));
    }
    public function addListingToFavorites(Request $request)
    {
        $user = Auth::user();
        $listingId = $request->input('listingId');

        // Retrieve the user's current favorite listings
        $favoriteListings = $user->favourite_listings ? json_decode($user->favourite_listings, true) : [];

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

        // Update the user's favorite listings in the database
        $user->favourite_listings = json_encode($favoriteListings);
        $user->save();

        // Redirect back to the current listing page
        return redirect()->back();
    }
}
