<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Experience;
use App\Models\Review;
use App\Models\User;
use App\Models\VendorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function home()
    {
        $featured = Experience::with('vendor')->where('status', 'active')->latest()->take(3)->get();
        return view('home', compact('featured'));
    }

    // dashboard shows different things for admin and user
    public function dashboard()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            $stats = [
                'experiences' => Experience::count(),
                'vendors'     => VendorProfile::count(),
                'reviews'     => Review::count(),
                'bookings'    => Booking::count(),
                'users'       => User::where('role', 'user')->count(),
            ];
            return view('dashboard', compact('user', 'stats'));
        }

        $myBookings = Booking::with('experience')->where('user_id', $user->id)->latest()->take(5)->get();
        return view('dashboard', compact('user', 'myBookings'));
    }

    public function contact()
    {
        return view('contact');
    }

    // additional form: contact / feedback form
    public function sendContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|max:100',
            'email'   => 'required|email',
            'message' => 'required|min:10',
        ]);

        return back()->with('success', 'Thank you! Your message has been sent.');
    }
}
