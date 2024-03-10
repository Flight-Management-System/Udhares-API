<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlightTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'aircraft',
        'start_location',
        'end_location',
    ];

    public function aircraft()
    {
        return $this->belongsTo(Aircraft::class, 'aircraft');
    }

    public function startLocation()
    {
        return $this->hasOne(Location::class, 'start_location');
    }

    public function endLocation()
    {
        return $this->hasOne(Location::class, 'end_location');
    }

    public function flights()
    {
        return $this->hasMany(Flight::class);
    }
}
