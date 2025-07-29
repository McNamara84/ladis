<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DamagePattern;
use App\Models\Condition;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Condition>
 */
class ConditionFactory extends Factory
{
    protected $model = Condition::class;

    public function definition(): array
    {
        return [
            'damage_pattern_id' => DamagePattern::factory(),
            'wac' => $this->faker->optional()->randomFloat(2, 0, 5),
            'description' => $this->faker->optional()->sentence(),
            'lab_l' => $this->faker->optional()->randomFloat(2, 0, 100),
            'lab_a' => $this->faker->optional()->randomFloat(2, -100, 100),
            'lab_b' => $this->faker->optional()->randomFloat(2, -100, 100),
            'severity' => $this->faker->word(),
            'adhesion' => $this->faker->word(),
        ];
    }
}
