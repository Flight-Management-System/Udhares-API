<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Group>
 */
class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $locations = Location::all();
        $fromLocation = $locations->random();
        $locations = $locations->where('id', '!=', $fromLocation->id);
        $toLocation = $locations->random();

        return [
            'from_location' => $fromLocation,
            'to_location' => $toLocation,
            'is_active' => fake()->boolean,
        ];
    }
}
