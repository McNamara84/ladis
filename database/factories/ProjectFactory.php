<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Person;
use App\Models\Venue;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    public function definition(): array
    {
        $startedAt = $this->faker->date();

        return [
            'name' => $this->faker->unique()->words(3, true),
            'description' => $this->faker->sentence(),
            'url' => $this->faker->unique()->url(),
            'started_at' => $startedAt,
            'person_id' => Person::factory(),
            'venue_id' => Venue::factory(),
            'ended_at' => $this->faker->dateTimeBetween($startedAt, '+2 years'),
        ];
    }
}
