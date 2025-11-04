<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    // public function Logout()
    // {
    //     Auth::logout();
    //     return Redirect()->route('login');
    // }


    /**
     * Logout user and redirect to login
     */
    public function logout(Request $request)
    {
        // Get the user type before logging out
        // $userType = Auth::user()->usertype ?? 'user';
        $role = Auth::user()->role ?? 'student';

        // Logout the user
        Auth::guard('web')->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Clear all session data
        Session::flush();

        // Notification message based on user type
        $notification = array(
            'message' => 'You Logged out. See you soon!',
            'alert-type' => 'success'
        );

        return redirect()->route('login')->with($notification);
    }
}
