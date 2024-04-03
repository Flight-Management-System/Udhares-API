<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Location;
use App\Models\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $isGoingAbrod = fake()->boolean(5);
        $isComingFromAbroad = fake()->boolean(5);

        return [
            'passenger' => Passenger::factory(),
            'pnr' => fake()->unique()->regexify('[A-Z]{3}[0-9]{6}'),
            'flight' => null,
            'flight_trip' => null,
            'group' => fake()->boolean(20) ? Group::factory() : null,
            'dept_location' => Location::factory(),
            'arr_location' => Location::factory(),
            'allowed_weight' => fake()->numberBetween(10, 20),
            'is_active' => fake()->boolean,
            'is_going_abroad' => $isGoingAbrod,
            'is_coming_from_abroad' => $isComingFromAbroad,
            'international_flight_no' => $isGoingAbrod || $isComingFromAbroad ? fake()->regexify('[A-Z]{2}[0-9]{4}') : null,
            'scheduled_dept_datetime' => $isGoingAbrod ? fake()->dateTimeBetween(now(), now()->addDays(1)) : null,
            'scheduled_arr_datetime' => $isComingFromAbroad ? fake()->dateTimeBetween(now(), now()->addDays(1)) : null,
        ];
    }
}
