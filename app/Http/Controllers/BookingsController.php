<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Carbon\Carbon;
use App\Models\Bookings;
use App\Models\RoomUnit;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingsController extends Controller
{
   public function create(Request $request)
    {
        $roomId = $request->input('room_id');
        $selectedRoom = null;
        $roomunits = collect();
    
        if ($roomId) {
            $selectedRoom = Room::find($roomId);
            if ($selectedRoom) {
            $roomunits = RoomUnit::where('room_id', $roomId)
                ->whereDoesntHave('bookings', function ($query) {
                    $query->whereIn('status', ['pending', 'confirmed']);
                })
                ->get();
        }
        }
    
        $today = Carbon::today();
    
        if (!$roomId && !$request->has('room_id')) {
            $roomunits = collect(); // kosong
        } else {
            $roomunits = RoomUnit::where('room_id', $roomId)
            ->whereDoesntHave('bookings', function($query) {
                $query->whereIn('status', ['pending', 'confirmed']);
            })
            ->get();
        }
    
        return view('booking', compact('roomId', 'roomunits', 'selectedRoom'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'room_unit_id' => 'required|exists:room_units,id',
            'room_id' => 'required|exists:rooms,id',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'notes' => 'nullable|string',
            'phone' => 'required|integer',
            'address' => 'required'
        ]);

        $existingBooking = Bookings::where('room_unit_id', $validated['room_unit_id'])
        ->where(function ($query) use ($validated) {
            $query->whereBetween('start_date', [$validated['start_date'], $validated['end_date']])
                ->orWhereBetween('end_date', [$validated['start_date'], $validated['end_date']])
                ->orWhere(function ($q) use ($validated) {
                    $q->where('start_date', '<=', $validated['start_date'])
                        ->where('end_date', '>=', $validated['end_date']);
                });
        })
        ->whereIn('status', ['pending', 'confirmed'])
        ->exists();

    if ($existingBooking) {
        return back()->withErrors(['room_unit_id' => 'Unit ini sudah dibooking di tanggal tersebut.'])->withInput();
    }


        Bookings::create([
            'user_id' => Auth::id(),
            'room_unit_id' => $validated['room_unit_id'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'notes' => $validated['notes'] ?? null,
            'status' => 'pending',
        ]);

        return redirect()->route('booking.create', ['room_id' => $validated['room_id']])
         ->with('success', 'Booking berhasil dikirim!');
    }
}
