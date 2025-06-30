<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::with('roomUnits')->get();

        $today = Carbon::today();
    
        foreach ($rooms as $room) {
            $totalUnits = $room->roomUnits->count();
    
            // Hitung jumlah unit yang sedang dibooking saat ini
            $bookedCount = $room->roomUnits->filter(function ($unit) use ($today) {
                return $unit->bookings()
                    ->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today)
                    ->where('status', 'confirmed') // atau pending juga?
                    ->exists();
            })->count();
    
            $room->is_fully_booked = $bookedCount >= $totalUnits;
        }
    
        return view('welcome', compact('rooms'));
    }
}
