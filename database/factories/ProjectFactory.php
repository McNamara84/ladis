<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name'=>fake()->unique()->words(3, true),
        'description'=>fake()->paragraph(),
        'url'=>fake()->unique(),
        'started_at'=>fake()->date(),
        'ended_at'=>fake()->date(),
        ];
    }
}
