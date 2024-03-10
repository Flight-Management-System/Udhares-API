<?php

use App\Models\FlightTrip;
use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(FlightTrip::class, 'flight_trip');
            $table->string('flight_no')->unique();
            $table->dateTime('dept_time');
            $table->dateTime('arr_time');
            $table->foreignIdFor(Location::class, 'dept_location');
            $table->foreignIdFor(Location::class, 'arr_location');
            $table->decimal('required_fuel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('flights');
    }
};
