<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Material;

/**
 * MaterialFactory for creating hierarchical material relationships
 *
 * Creates parent materials and their child materials for historic surface cleaning context.
 * Uses German terminology consistent with the project.
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Material>
 */
class MaterialFactory extends Factory
{
    /**
     * List of parent material names in German
     *
     * @var array<string>
     */
    public const PARENT_MATERIALS = [
        'Holz',
        'Stein',
        'Metall',
        'Keramik',
        'Glas',
        'Textil',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(self::PARENT_MATERIALS),
            'parent_id' => null,
        ];
    }
}
