<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Pagination\Paginator;


class EventController extends Controller
{
    public function showEventsPage()
    {
        $user = Auth::user();
    
        if ($user && $user->approved) {
            $events = Event::where('approved', 1)->paginate(6);

            Paginator::useBootstrap(); // Use Bootstrap styling for the pagination links

            return view('pages.events', compact('events'));
        }
    
        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'postalcode' => 'required',
            'date' => 'required',
            'starttime' => 'required',
            'endtime' => 'required',
            'fee' => 'required',
            'description' => 'required',
            'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add validation rule for the picture field
        ]);

        $imageName = null;

        if ($request->hasFile('picture')) {
            $image = $request->file('picture');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('event-images'), $imageName);
        }

        Event::create([
            'title' => strtoupper($request->title),
            'location' => $request->location,
            'postalcode' => $request->postalcode,
            'date' => $request->date,
            'starttime' => $request->starttime,
            'endtime' => $request->endtime,
            'fee' => $request->fee,
            'description' => $request->description,
            'picture' => $imageName, // Save the image name in the 'picture' column
            'created_by' => Auth::user()->lastname .' '. Auth::user()->firstname,
            'approved' => 0,
        ]);
        

        // Redirect back to the current listing page
        return redirect()->back();
    }
    public function showEventDetails($id)
    {
        $event = Event::find($id);
        return view('pages.event-detail', compact('event'));
    }
    public function addEventToFavorites(Request $request)
    {
        $user = Auth::user();
        $eventId = $request->input('eventId');

        // Retrieve the user's current favorite listings
        $favoriteEvents = $user->favourite_events ? json_decode($user->favourite_events, true) : [];

        // Convert the existing string value to an array if it's not already
        if (!is_array($favoriteEvents)) {
            $favoriteEvents = [$favoriteEvents];
        }

        // Add or remove the listing ID from the favorites array based on its presence
        if (in_array($eventId, $favoriteEvents)) {
            // Remove the listing ID from favorites
            $favoriteEvents = array_diff($favoriteEvents, [$eventId]);
        } else {
            // Add the listing ID to favorites
            $favoriteEvents[] = $eventId;
        }

        // Update the user's favorite listings in the database
        $user->favourite_events = json_encode($favoriteEvents);
        $user->save();

        // Redirect back to the current listing page
        return redirect()->back();

    } 
}
