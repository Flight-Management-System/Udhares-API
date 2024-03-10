<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'shortcode',
        'lat',
        'long',
        'platform_count',
        'is_fuelable',
        'is_maintenance_base',
    ];
}
