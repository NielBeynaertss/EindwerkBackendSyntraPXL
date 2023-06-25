<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Youthorganisation;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;



class LoginRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout', 'dashboard'
        ]);
    }
    public function register()
    {
        $youthorganisations = Youthorganisation::all(); // Fetch all youth organizations from the database
        return view('auth.register', compact('youthorganisations'));
    }
    public function storeNewMember(Request $request)
    {
        $request->validate([
            'lastname' => 'required|string|max:250',
            'firstname' => 'required|string|max:250',
            'email' => 'required|email|max:250|unique:users',
            'phone' => 'required|string|max:250',
            'streetnr' => 'required|string|max:250',
            'city' => 'required|string|max:250',
            'postalcode' => ['required', 'regex:/^\d{4}$/'],
            'youthorganisation' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
    
        $user = User::create([
            'lastname' => $request->lastname,
            'firstname' => $request->firstname,
            'email' => $request->email,
            'phone' => $request->phone,
            'streetnr' => $request->streetnr,
            'city' => $request->city,
            'postalcode' => $request->postalcode,
            'password' => Hash::make($request->password),
            'approved' => 0,
            'youthorganisation_id' => $request->youthorganisation,
            'approved_email_sent' => 0,
        ]);
    
        // Additional logic, such as sending email verification, logging in the user, etc.
        Mail::send('mail.registration-mail', ['firstname' => $request->firstname, 'lastname' => $request->lastname], function($message) use ($request) {
            $message->to($request->email)
                ->subject('Bedankt voor uw registratie, '.$request->firstname.'.');
        });
    
        return view('welcome');
    }
    public function login()
    {
        return view('auth.login');
    }
    public function authenticate(Request $request)
    {
        // Validate the login form data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        // Perform authentication logic here (e.g., check credentials against the database)
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            // Authentication successful
            return redirect()->route('dashboard')->with('success', 'Login successful!');
        } else {
            // Authentication failed
            return redirect()->back()->withErrors(['email' => 'Invalid credentials.']);
        }
    }
    public function dashboard()
    {
        if(Auth::check())
        {
            return view('auth.dashboard');
        }
        
        return redirect()->route('login')
            ->withErrors([
            'email' => 'Please login to access the dashboard.',
        ])->onlyInput('email');
    } 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
            ->withSuccess('You have logged out successfully!');;
    }    
    public function showForgotPasswordPage(Request $request)
    {
        return view('auth.forgot-password');    
    }
    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:250|exists:users,email',
        ]);

        $status = Password::sendResetLink($request->only('email'));


        if ($status === Password::RESET_LINK_SENT) {
            return redirect()->back()->with('success', 'Password reset link sent to your email!');
        } else {
            return redirect()->back()->withErrors(['email' => __($status)]);
        }
    }
    public function showResetForm(Request $request, $token)
    {
        return view('auth.new-password', compact('token'));    
    }    
    public function resetPassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email|max:250',
            'password' => 'required|min:8|confirmed',
        ]);

        $credentials = $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );

        $status = Password::reset($credentials, function ($user, $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->save();
        });

        if ($status === Password::PASSWORD_RESET) {
            return redirect()->route('login')->with('success', 'Your password has been reset successfully!');
        } else {
            return redirect()->back()->withErrors(['email' => __($status)]);
        }
    }

    

}