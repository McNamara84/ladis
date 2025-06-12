<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Process>
 */
class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partial_surface_id'    =>  1,
            'device_id'             =>  2,
            'configuration_id'      =>  3,
            'description'           =>  Str::random(20),
            'duration'              =>  fake()->randomElement([0, 1, 2, 3]),
            'wet'                   =>  fake()->randomElement([0, 1]),
        ];
    }
}
