<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RoomUnit extends Model
{
    protected $fillable = [
        "room_id",
        "unit_number"
    ];
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
    
    public function customer()
    {
        return $this->hasOne(Customer::class);
    }
}
