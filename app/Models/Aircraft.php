<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aircraft extends Model
{
    use HasFactory;

    protected $fillable = [
        'reg_no',
        'seat_count',
        'dow',
        'mtow',
        'ktas',
        'fuel_capacity',
        'is_active',
        'last_compwash',
        'cg_index',
        'current_location'
    ];

    public function currentLocation()
    {
        return $this->hasOne(Location::class, 'current_location');
    }
}
