<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
    public function create()
    {
        $rooms = Room::where('is_available', true)->get();

        return view('booking', compact('rooms'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
        ]);

        Bookings::create([
            'user_id' => Auth::id(),
            'room_id' => $validated['room_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.create')->with('success', 'Booking berhasil dikirim! Tunggu konfirmasi dari admin.');
    }
}
