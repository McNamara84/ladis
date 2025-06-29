<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DamagePattern>
 */
class DamagePatternFactory extends Factory
{    
    public static array $patterns = [
        'Auflagerungskruste',
        'Graffiti',
        'Verrußung',
        'Umwandlungskruste',
        'biogener Bewuchs'
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(self::$patterns)
        ];
    }
}
