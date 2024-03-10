<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'from_location',
        'to_location',
        'is_active',
    ];

    public function fromLocation()
    {
        return $this->hasOne(Location::class, 'from_location');
    }

    public function toLocation()
    {
        return $this->hasOne(Location::class, 'to_location');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
