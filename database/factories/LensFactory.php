<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lens>
 */
class LensFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // Size must be a unique unsigned tiny integer (1–255), based on migration and data model
            // Creation of lenses with size 0 is intentionally excluded
            'size' => fake()->unique()->numberBetween(1 ,255),
        ];
    }
}
