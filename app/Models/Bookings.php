<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bookings extends Model
{
    protected $fillable = [
        'user_id',
        "room_unit_id",
        'start_date',
        'end_date',
        'notes',
        'status',
    ];
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function roomUnit()
    {
        return $this->belongsTo(RoomUnit::class);
    }
    
    public function room() {
        return $this->belongsTo(Room::class);
    }
}
