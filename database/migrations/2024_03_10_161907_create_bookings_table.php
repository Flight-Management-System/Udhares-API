<?php

use App\Models\Flight;
use App\Models\FlightTrip;
use App\Models\Group;
use App\Models\Location;
use App\Models\Passenger;
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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Passenger::class, 'passenger');
            $table->string('pnr')->unique();
            $table->foreignIdFor(Flight::class, 'flight')->nullable();
            $table->foreignIdFor(FlightTrip::class, 'flight_trip')->nullable();
            $table->foreignIdFor(Group::class, 'group')->nullable();
            $table->foreignIdFor(Location::class, 'dept_location');
            $table->foreignIdFor(Location::class, 'arr_location');
            $table->integer('allowed_weight');
            $table->boolean('is_active');
            $table->boolean('is_going_abroad')->nullable();
            $table->boolean('is_coming_from_abroad')->nullable();
            $table->string('international_flight_no')->nullable();
            $table->dateTime('scheduled_dept_datetime')->nullable();
            $table->dateTime('scheduled_arr_datetime')->nullable();
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
        Schema::dropIfExists('bookings');
    }
};
