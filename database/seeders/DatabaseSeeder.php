<?php

namespace Database\Seeders;

use App\Models\Aircraft;
use App\Models\Booking;
use App\Models\Group;
use App\Models\Location;
use App\Models\Passenger;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $locations = Location::factory(10)->create();
        Group::factory(5)->recycle($locations)->create();
        Aircraft::factory(10)->recycle($locations)->create();
        Passenger::factory(100)->create()->each(function ($passenger) {
            Booking::factory(1)->recycle($passenger)->create();
        });
    }
}
