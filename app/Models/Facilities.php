<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Facilities extends Model
{
    protected $fillable = [
        'name',
        'description',
        'quantity'
    ];
    public function rooms() {
        return $this->belongsToMany(Room::class, 'facility_room', 'room_id', 'facility_id');
    }
}
