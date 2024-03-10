<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    use HasFactory;

    protected $fillable = [
        'flight_trip',
        'flight_no',
        'dept_time',
        'arr_time',
        'dept_location',
        'arr_location',
        'required_fuel',
    ];

    public function flightTrip()
    {
        return $this->belongsTo(FlightTrip::class, 'flight_trip');
    }

    public function deptLocation()
    {
        return $this->hasOne(Location::class, 'dept_location');
    }

    public function arrLocation()
    {
        return $this->hasOne(Location::class, 'arr_location');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
