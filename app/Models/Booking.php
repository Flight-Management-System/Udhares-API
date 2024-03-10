<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'passenger',
        'pnr',
        'flight',
        'flight_trip',
        'group',
        'dept_location',
        'arr_location',
        'allowed_weight',
        'is_active',
        'is_going_abroad',
        'is_coming_from_abroad',
        'international_flight_no',
        'scheduled_dept_datetime',
        'scheduled_arr_datetime',
    ];

    public function passenger()
    {
        return $this->belongsTo(Passenger::class);
    }

    public function flight()
    {
        return $this->belongsTo(Flight::class);
    }

    public function flightTrip()
    {
        return $this->belongsTo(FlightTrip::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }
}
