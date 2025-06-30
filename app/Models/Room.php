<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'is_available',
        'image',
        'room_number',
        'capacity',
    ];
    
    public function facilities() 
    {
        return $this->belongsToMany(Facilities::class, 'facility_room', 'room_id', 'facility_id');
    }
    
    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }

    public function customer()
    {
        return $this->hasOne(Customer::class);
    }

    public function roomUnits()
    {
        return $this->hasMany(RoomUnit::class);
    }
}
