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
        // TODO: Implement child material creation test
        $this->markTestIncomplete('Test not yet implemented');
    }
}
