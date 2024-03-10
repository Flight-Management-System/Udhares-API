<?php

use App\Models\Aircraft;
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
        Schema::create('flight_trips', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Aircraft::class, 'aircraft');
            $table->foreignIdFor(Location::class, 'start_location');
            $table->foreignIdFor(Location::class, 'end_location');
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
        Schema::dropIfExists('flight_trips');
    }
};
