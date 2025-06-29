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
     * Hierarchical material structure with parent materials and their children
     *
     * @var array<string, array<string>>
     */
    public const MATERIAL_HIERARCHY = [
        'Holz' => ['Eiche', 'Buche', 'Kiefer', 'Tanne', 'Fichte', 'Birke'],
        'Stein' => ['Sandstein', 'Marmor', 'Granit', 'Kalkstein', 'Schiefer', 'Basalt'],
        'Metall' => ['Bronze', 'Eisen', 'Kupfer', 'Zinn', 'Silber', 'Gold'],
        'Keramik' => ['Terrakotta', 'Porzellan', 'Steingut', 'Fayence', 'Majolika'],
        'Glas' => ['Bleiglas', 'Kalkglas', 'Borosilikatglas', 'Kristallglas'],
        'Textil' => ['Seide', 'Wolle', 'Leinen', 'Baumwolle', 'Samt'],
    ];

    /**
     * Get list of parent material names derived from hierarchy keys
     *
     * @return array<string>
     */
    public static function getParentMaterials(): array
    {
        return array_keys(self::MATERIAL_HIERARCHY);
    }

    /**
     * Get list of child material names for a given parent material name
     *
     * @param string $parentMaterialName
     * @return array<string>
     */
    public static function getChildMaterials(string $parentMaterialName): array
    {
        return self::MATERIAL_HIERARCHY[$parentMaterialName] ?? [];
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement(self::getParentMaterials()),
            'parent_id' => null,
        ];
    }

    /**
     * Explicitly create a parent material (no parent_id)
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function parent(): Factory
    {
        return $this->state(fn(array $attributes) => [
            'parent_id' => null,
        ]);
    }

    /**
     * Create a child material with a parent
     *
     * @param Material|null $parent Optional parent material, if null creates a random parent
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function child(?Material $parent = null): Factory
    {
        return $this->state(function (array $attributes) use ($parent) {
            // If no parent is provided, create a random parent
            if (!$parent) {
                $parent = Material::factory()->parent()->create();
            }

            // Get child materials for the parent type
            $childMaterials = self::getChildMaterials($parent->name);
            $childName = fake()->unique()->randomElement($childMaterials);

            return [
                'parent_id' => $parent->id,
                'name' => $childName,
            ];
        });
    }

    /**
     * Create any material (parent or child) randomly
     */
    public function any(): Factory
    {
        return $this->state(function (array $attributes) {
            $allMaterials = [];

            // Add all parent materials
            foreach (self::getParentMaterials() as $parent) {
                $allMaterials[] = ['name' => $parent, 'parent_id' => null];
            }

            // Add all child materials with their parent relationships
            foreach (self::MATERIAL_HIERARCHY as $parentName => $children) {
                foreach ($children as $childName) {
                    $allMaterials[] = ['name' => $childName, 'parent_name' => $parentName];
                }
            }

            $randomMaterial = fake()->randomElement($allMaterials);

            if (isset($randomMaterial['parent_name'])) {
                // Congratulations, it's a child material!
                $parent = Material::firstOrCreate(['name' => $randomMaterial['parent_name']]);
                return ['name' => $randomMaterial['name'], 'parent_id' => $parent->id];
            }

            return $randomMaterial;
        });
    }
}
