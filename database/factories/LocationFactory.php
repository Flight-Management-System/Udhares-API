<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->city,
            'shortcode' => fake()->unique()->regexify('[A-Z]{3}'),
            'lat' => fake()->latitude(-0.690, 7.100),
            'long' => fake()->longitude(72.000, 73.600),
            'platform_count' => fake()->numberBetween(1, 3),
            'is_fuelable' => fake()->boolean,
            'is_maintenance_base' => fake()->boolean,
        ];
    }
}
