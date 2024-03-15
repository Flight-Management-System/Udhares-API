<?php

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
        Schema::create('aircrafts', function (Blueprint $table) {
            $table->id();
            $table->string('reg_no');
            $table->integer('seat_count');
            $table->integer('dow');
            $table->integer('mtow');
            $table->integer('ktas');
            $table->integer('fuel_capacity');
            $table->boolean('is_active');
            $table->dateTime('last_compwash')->nullable();
            $table->integer('cg_index');
            $table->foreignIdFor(Location::class, 'current_location');
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
        Schema::dropIfExists('aircrafts');
    }
};
