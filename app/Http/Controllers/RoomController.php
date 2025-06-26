<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::All(); // hanya kamar yang kosong
        return view('welcome', compact('rooms'));
    }
}
