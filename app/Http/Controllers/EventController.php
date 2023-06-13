<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Member;
use App\Models\Event;

class EventController extends Controller
{
    public function showEventsPage()
    {
        $member = Auth::guard('member')->user();
    
        if ($member && $member->approved) {
            $events = Event::all();
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
        ]);

        Event::create([
            'title' => strtoupper($request->title),
            'location' => $request->location,
            'date' => $request->date,
            'starttime' => $request->starttime,
            'endtime' => $request->endtime,
            'fee' => $request->fee,
            'description' => $request->description,
            'created_by' => Auth::guard('member')->user()->lastname .' '. Auth::guard('member')->user()->firstname,
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
