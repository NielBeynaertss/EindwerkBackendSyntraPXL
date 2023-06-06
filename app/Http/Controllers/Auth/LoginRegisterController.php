<?php

namespace App\Http\Controllers\Auth;

use App\Models\Member;
use App\Models\Youthorganisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginRegisterController extends Controller
{
    /**
     * Instantiate a new LoginRegisterController instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }

    /**
     * Display a registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function register()
    {
        $youthorganisations = Youthorganisation::all(); // Fetch all youth organizations from the database
        return view('auth.register', compact('youthorganisations'));
    }
    

    /**
     * Store a new user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:250',
            'firstname' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'phone' => 'required|string|max:250',
            'streetnr' => 'required|string|max:250',
            'city' => 'required|string|max:250',
            'postalcode' => 'required|string|max:250',
            'youthorganisation' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        Member::create([
            'lastname' => $request->lastname, // Fix the field name here
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'streetnr' => $request->streetnr,
            'city' => $request->city,
            'postalcode' => $request->postalcode,
            'password' => Hash::make($request->password),
            'approved' => 0,
            'youthorganisation_id' => ($request->youthorganisation),
        ]);
        
        return view('welcome');
    }

    /**
     * Display a login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('auth.login');
    }

    /**
     * Authenticate the user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */



    public function authenticate(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Perform authentication logic here (e.g., check credentials against the database)
        $credentials = $request->only('email', 'password');

        if (Auth::guard('member')->attempt($credentials)) {
            // Authentication successful
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }

    
    /**
     * Display a dashboard to authenticated users.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        if(Auth::guard('member')->check())
        {
            return view('auth.dashboard');
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
    
    /**
     * Log out the user from application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    

}