<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FederalState>
 */
class FederalStateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public static array $federalStates = [
        'Baden-Württemberg',
        'Bayern',
        'Berlin',
        'Brandenburg',
        'Bremen',
        'Hamburg',
        'Hessen',
        'Mecklenburg-Vorpommern',
        'Niedersachsen',
        'Nordrhein-Westfalen',
        'Rheinland-Pfalz',
        'Saarland',
        'Sachsen',
        'Sachsen-Anhalt',
        'Schleswig-Holstein',
        'Thüringen',
    ];

    public function definition(): array
    {
        return [
            'name' => 'TestState ' . fake()->unique()->numerify('###'),
        ];
    }

    /**
     * Sequence through all federal states for seeding.
     */
    public function germanStates(): self
    {
        return $this->sequence(
            fn ($sequence) => ['name' => self::$federalStates[$sequence->index]]
        );
    }
}
