<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Artifact;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SampleSurface>
 */
class SampleSurfaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'artifacts_id' => Artifact::factory(),
            'name' => $this->faker->unique()->bothify('Sample-##'),
            'description' => $this->faker->sentence(),
        ];
    }
}
