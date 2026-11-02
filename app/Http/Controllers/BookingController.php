<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    // READ: admin sees all bookings, user sees own bookings only. Filter by status.
    public function index(Request $request)
    {
        $query = Booking::with(['experience', 'user']);

        if (!Auth::user()->isAdmin()) {
            $query->where('user_id', Auth::id());
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $bookings = $query->latest()->get();
        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $experiences = Experience::where('status', 'active')->get();
        $selected = $request->experience_id;
        return view('bookings.create', compact('experiences', 'selected'));
    }

    // CREATE: total price is calculated on the server (price x pax)
    public function store(Request $request)
    {
        $data = $request->validate([
            'experience_id' => 'required|exists:experiences,id',
            'booking_date'  => 'required|date|after_or_equal:today',
            'pax'           => 'required|integer|min:1|max:20',
        ]);

        $experience = Experience::findOrFail($data['experience_id']);

        Booking::create([
            'user_id'       => Auth::id(),
            'experience_id' => $experience->id,
            'booking_date'  => $data['booking_date'],
            'pax'           => $data['pax'],
            'total_price'   => $experience->price * $data['pax'],
            'status'        => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking made! Please wait for confirmation.');
    }

    public function edit(Booking $booking)
    {
        $this->checkOwner($booking);
        $experiences = Experience::all();
        return view('bookings.edit', compact('booking', 'experiences'));
    }

    // UPDATE: user can change date and pax, admin can also change status
    public function update(Request $request, Booking $booking)
    {
        $this->checkOwner($booking);

        $rules = [
            'booking_date' => 'required|date',
            'pax'          => 'required|integer|min:1|max:20',
        ];
        if (Auth::user()->isAdmin()) {
            $rules['status'] = 'required|in:pending,confirmed,cancelled';
        }
        $data = $request->validate($rules);

        $data['total_price'] = $booking->experience->price * $data['pax'];
        $booking->update($data);

        return redirect()->route('bookings.index')->with('success', 'Booking updated!');
    }

    // DELETE
    public function destroy(Booking $booking)
    {
        $this->checkOwner($booking);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted.');
    }

    private function checkOwner(Booking $booking)
    {
        if (!Auth::user()->isAdmin() && $booking->user_id !== Auth::id()) {
            abort(403, 'This is not your booking.');
        }
    }
}
