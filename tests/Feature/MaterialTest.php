<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Material;

class MaterialTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Ensure circular references are detected when assigning a descendant as parent.
     */
    public function test_would_create_circular_reference(): void
    {
        $a = Material::create(['name' => 'A']);
        $b = Material::create(['name' => 'B', 'parent_id' => $a->id]);
        // create a third level material bypassing model events to test the method
        $c = Material::withoutEvents(function () use ($b) {
            return Material::create(['name' => 'C', 'parent_id' => $b->id]);
        });

        $this->assertTrue($a->wouldCreateCircularReference($b->id));
        $this->assertTrue($a->wouldCreateCircularReference($c->id));
    }

    /**
     * Ensure no circular reference is detected for valid parent IDs.
     */
    public function test_would_not_create_circular_reference(): void
    {
        $a = Material::create(['name' => 'A']);
        $b = Material::create(['name' => 'B', 'parent_id' => $a->id]);

        $this->assertFalse($b->wouldCreateCircularReference($a->id));
        $this->assertFalse($a->wouldCreateCircularReference(999));
    }

    /**
     * A material should know its children via the relation.
     */
    public function test_children_relationship_returns_child_materials(): void
    {
        $parent = Material::create(['name' => 'Parent']);
        $child1 = Material::create(['name' => 'Child1', 'parent_id' => $parent->id]);
        $child2 = Material::create(['name' => 'Child2', 'parent_id' => $parent->id]);

        $children = $parent->children()->get();

        $this->assertCount(2, $children);
        $this->assertTrue($children->contains($child1));
        $this->assertTrue($children->contains($child2));
    }

    /**
     * A material cannot be its own parent.
     */
    public function test_saving_self_as_parent_throws_exception(): void
    {
        $material = Material::create(['name' => 'M']);

        $material->parent_id = $material->id;

        $this->expectException(\InvalidArgumentException::class);
        $material->save();
    }

    /**
     * Assigning a descendant as parent should trigger a validation error.
     */
    public function test_saving_descendant_as_parent_throws_exception(): void
    {
        $a = Material::create(['name' => 'A']);
        $b = Material::create(['name' => 'B', 'parent_id' => $a->id]);
        // create third level material bypassing events
        $c = Material::withoutEvents(function () use ($b) {
            return Material::create(['name' => 'C', 'parent_id' => $b->id]);
        });

        $a->parent_id = $c->id;

        $this->expectException(\InvalidArgumentException::class);
        $a->save();
    }

    public function test_saving_child_of_child_throws_exception(): void
    {
        $top = Material::create(['name' => 'Top']);
        $child = Material::create(['name' => 'Child', 'parent_id' => $top->id]);

        $third = new Material(['name' => 'Third', 'parent_id' => $child->id]);

        $this->expectException(\InvalidArgumentException::class);
        $third->save();
    }

    public function test_material_with_children_cannot_be_assigned_parent(): void
    {
        $grand = Material::create(['name' => 'Grand']);
        $parent = Material::create(['name' => 'Parent']);
        Material::create(['name' => 'Child', 'parent_id' => $parent->id]);

        $parent->parent_id = $grand->id;

        $this->expectException(\InvalidArgumentException::class);
        $parent->save();
    }

    public function test_assigning_parent_with_parent_throws_exception(): void
    {
        $grand = Material::create(['name' => 'Grand']);
        $parent = Material::create(['name' => 'Parent', 'parent_id' => $grand->id]);
        $child = Material::create(['name' => 'Child']);

        $child->parent_id = $parent->id;

        $this->expectException(\InvalidArgumentException::class);
        $child->save();
    }
}
