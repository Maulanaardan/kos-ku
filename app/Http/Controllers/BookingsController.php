<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Carbon\Carbon;
use App\Models\Bookings;
use App\Models\RoomUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
   public function create(Request $request)
    {
        $roomId = $request->input('room_id');
        $selectedRoom = null;
    
        if ($roomId) {
            $selectedRoom = Room::find($roomId);
        }
    
        $today = Carbon::today();
    
        if (!$roomId && !$request->has('room_id')) {
            $roomunits = collect(); // kosong
        } else {
            $roomunits = RoomUnit::with('room')
                ->where('room_id', $roomId)
                ->whereDoesntHave('bookings', function ($query) use ($today) {
                    $query->where('start_date', '<=', $today)
                          ->where('end_date', '>=', $today)
                          ->where('status', 'confirmed');
                })
                ->get();
        }
    
        return view('booking', compact('roomunits', 'selectedRoom'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_unit_id' => 'required|exists:room_units,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
            'phone' => 'required|integer',
            'address' => 'required'
        ]);

         // Cek apakah customer sudah ada
        $existingCustomer = Customer::where('user_id', auth()->id())->first();

        if (!$existingCustomer) {
            Customer::create([
                'user_id' => auth()->id(),
                'name' => auth()->user()->name,
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'room_id' => RoomUnit::find($validated['room_unit_id'])->room_id,
            ]);
        }

        Bookings::create([
            'user_id' => Auth::id(),
            'room_unit_id' => $validated['room_unit_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.create')->with('success', 'Booking berhasil dikirim! Tunggu konfirmasi dari admin.');
    }
}
