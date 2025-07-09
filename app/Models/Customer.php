<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'name',
        'room_number',
        'phone',
        'address'
    ];

    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    public function roomunit()
    {
        return $this->belongsTo(Room::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
