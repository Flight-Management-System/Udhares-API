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
        $isGoingAbroad = fake()->boolean(5);
        $isComingFromAbroad = fake()->boolean(5);
        $group = fake()->boolean(20) ? Group::all()->random() : null;

        if ($group) {
            $fromLocation = $group->from_location;
            $toLocation = $group->to_location;
        } else {
            $locations = Location::all();
            $fromLocation = $locations->random();
            $locations = $locations->where('id', '!=', $fromLocation->id);
            $toLocation = $locations->random();
        }

        return [
            'passenger' => Passenger::factory(),
            'pnr' => fake()->unique()->regexify('[A-Z]{3}[0-9]{6}'),
            'flight' => null,
            'flight_trip' => null,
            'group' => $group,
            'dept_location' => $fromLocation,
            'arr_location' => $toLocation,
            'allowed_weight' => fake()->numberBetween(10, 20),
            'is_active' => fake()->boolean,
            'is_going_abroad' => $isGoingAbroad,
            'is_coming_from_abroad' => $isComingFromAbroad,
            'international_flight_no' => $isGoingAbroad || $isComingFromAbroad ? fake()->regexify('[A-Z]{2}[0-9]{4}') : null,
            'scheduled_dept_datetime' => $isGoingAbroad ? fake()->dateTimeBetween(now(), now()->addDays(1)) : null,
            'scheduled_arr_datetime' => $isComingFromAbroad ? fake()->dateTimeBetween(now(), now()->addDays(1)) : null,
        ];
    }
}
