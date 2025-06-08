<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => 1,
            'name' => fake()->randomElement([
                'Kölner Dom',
                'Schloss Bellevue',
                'Brandenburger Tor'
            ]),
        ];
    }
}
