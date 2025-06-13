<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Artifact>
 */
class ArtifactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'location_id' => 1,
            'name' => fake()->randomElement([
                'Schrank',
                'Treppe',
                'Mosaik',
            ]),
            'inventory_number' => fake()->unique()->numerify('INV-#####'),
        ];
    }
}
