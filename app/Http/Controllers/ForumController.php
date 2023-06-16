<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function showForumPage()
    {
        $user = Auth::user();
    
        if ($user && $user->approved) {
            return view('vendor.forum.master');
        }
    
        return redirect()->route('dashboard')->with('message', 'This page can only be accessed once your account has been approved.');
    }
}
