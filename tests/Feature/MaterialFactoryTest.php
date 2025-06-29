<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Material;
use Database\Factories\MaterialFactory;

/**
 * MaterialFactoryTest
 *
 * Tests for the MaterialFactory functionality including:
 * - Basic material creation
 * - Parent and child material relationships
 * - Hierarchical material structure
 * - Helper methods for accessing material data
 */
class MaterialFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test basic material creation using factory default state
     */
    public function test_material_can_be_created_with_default_state(): void
    {
        $material = Material::factory()->create();

        $this->assertDatabaseHas('materials', [
            'id' => $material->id,
            'name' => $material->name,
            'parent_id' => null,
        ]);

        // Verify the name is one of the expected parent materials
        $this->assertContains($material->name, MaterialFactory::getParentMaterials());
    }

    /**
     * Test creating parent materials explicitly
     */
    public function test_parent_material_creation(): void
    {
        $parentMaterial = Material::factory()->parent()->create();

        // Verify the parent material has no parent
        $this->assertNull($parentMaterial->parent_id);

        // Verify the name is one of the expected parent materials
        $this->assertContains($parentMaterial->name, MaterialFactory::getParentMaterials());

        // Test creating multiple parent materials
        $count = 3;
        $materials = Material::factory()->parent()->count($count)->create();

        $this->assertCount($count, $materials);
        foreach ($materials as $material) {
            $this->assertNull($material->parent_id);
            $this->assertContains($material->name, MaterialFactory::getParentMaterials());
        }
    }

    /**
     * Test creating child materials with parent relationship
     */
    public function test_child_material_creation(): void
    {
        // Create a parent material first
        $parentMaterial = Material::factory()->parent()->create(['name' => 'Holz']);

        // Create a child material with the parent
        $childMaterial = Material::factory()->child($parentMaterial)->create();

        // Verify the child material has the correct parent
        $this->assertEquals($parentMaterial->id, $childMaterial->parent_id);

        // Verify the child name is from the correct hierarchy
        $expectedChildMaterials = MaterialFactory::getChildMaterials($parentMaterial->name);
        $this->assertContains($childMaterial->name, $expectedChildMaterials);

        // Test the relationship works in both directions
        $this->assertTrue($parentMaterial->children->contains($childMaterial));
        $this->assertEquals($parentMaterial->name, $childMaterial->parent->name);
    }

    /**
     * Test creating child materials without explicit parent (factory creates random parent)
     */
    public function test_child_material_creation_with_auto_parent(): void
    {
        $childMaterial = Material::factory()->child()->create();

        // Verify child has a parent
        $this->assertNotNull($childMaterial->parent_id);
        $this->assertInstanceOf(Material::class, $childMaterial->parent);

        // Verify parent is a valid parent material
        $this->assertContains($childMaterial->parent->name, MaterialFactory::getParentMaterials());
        $this->assertNull($childMaterial->parent->parent_id);

        // Verify child name matches parent's hierarchy
        $expectedChildMaterials = MaterialFactory::getChildMaterials($childMaterial->parent->name);
        $this->assertContains($childMaterial->name, $expectedChildMaterials);
    }

    /**
     * Test creating multiple child materials for the same parent
     */
    public function test_multiple_child_materials_creation(): void
    {
        $parentMaterialName = 'Stein';
        $parentMaterial = Material::factory()->parent()->create(['name' => $parentMaterialName]);
        $childCount = 3;

        $childMaterials = Material::factory()->child($parentMaterial)->count($childCount)->create();

        $this->assertCount($childCount, $childMaterials);

        $expectedChildMaterials = MaterialFactory::getChildMaterials($parentMaterialName);
        foreach ($childMaterials as $child) {
            $this->assertEquals($parentMaterial->id, $child->parent_id);
            $this->assertContains($child->name, $expectedChildMaterials);
        }

        // Verify parent has all children
        $this->assertCount($childCount, $parentMaterial->children);
    }
}
