<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Aircraft>
 */
class AircraftFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'reg_no' => fake()->unique()->regexify('[A-Z]{3}-[0-9]{3}'),
            'seat_count' => fake()->numberBetween(8, 12),
            'dow' => fake()->numberBetween(1000, 2000),
            'mtow' => fake()->numberBetween(2000, 3000),
            'ktas' => fake()->numberBetween(100, 200),
            'fuel_capacity' => fake()->numberBetween(100, 200),
            'is_active' => fake()->boolean,
            'last_compwash' => fake()->dateTimeBetween(now()->subDays(rand(1, 2)), now()),
            'cg_index' => fake()->numberBetween(1, 10),
            'current_location' => Location::factory(),
        ];
    }
}
