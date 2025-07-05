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
 *
 * @example Basic material creation (creates random parent material)
 * $material = Material::factory()->create();
 * // Creates: Material { name: 'Holz', parent_id: null }
 *
 * @example Create specific parent material
 * $woodMaterial = Material::factory()->parent()->create(['name' => 'Holz']);
 * // Creates: Material { name: 'Holz', parent_id: null }
 *
 * @example Create child material with specific parent
 * $parent = Material::factory()->parent()->create(['name' => 'Holz']);
 * $child = Material::factory()->child($parent)->create();
 * // Creates: Material { name: 'Eiche', parent_id: 1 } (random child of Holz)
 *
 * @example Create child material with auto-generated parent
 * $child = Material::factory()->child()->create();
 * // Creates parent first, then child with relationship
 *
 * @example Create multiple materials of same type
 * $parents = Material::factory()->parent()->count(3)->create();
 * // Creates 3 different parent materials
 *
 * @example Create complete material family
 * $stoneMaterial = Material::factory()->parent()->create(['name' => 'Stein']);
 * $stoneTypes = Material::factory()->child($stoneMaterial)->count(6)->create();
 * // Creates 'Stein' parent with all 6 child materials (Sandstein, Marmor, etc.)
 *
 * @example Create random materials (parent or child)
 * $materials = Material::factory()->any()->count(10)->create();
 * // Creates mix of parent and child materials randomly
 *
 * @example Seeding scenario - create all materials from hierarchy
 * foreach (MaterialFactory::getParentMaterials() as $parentName) {
 *     $parent = Material::factory()->parent()->create(['name' => $parentName]);
 *     foreach (MaterialFactory::getChildMaterials($parentName) as $childName) {
 *         Material::factory()->child($parent)->create(['name' => $childName]);
 *     }
 * }
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
        $isParent = fake()->boolean();

        if ($isParent) {
            return $this->parent();
        }

        return $this->child();
    }
}
