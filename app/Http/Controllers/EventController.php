<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{

    
    public function showEventsPage()
    {
        $user = Auth::user();
    
        if ($user && $user->approved) {
            $events = Event::where('approved', 1)->get();
            return view('pages.events', compact('events'));
        }
    
        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }

    public function storeEvent(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
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
    


}
