<?php

namespace Database\Seeders;

use App\Models\Aircraft;
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
        $aircrafts = Aircraft::factory(10)->recycle($locations)->create();
        $passengers = Passenger::factory(100)->create();
    }
}
