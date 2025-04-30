<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name',
        'description',
        'location',
        'capacity',
        'is_available',
    ];

    // public function bookings()
    // {
    //     return $this->hasMany(Booking::class);
    // }
}
