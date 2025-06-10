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
        $c = Material::create(['name' => 'C', 'parent_id' => $b->id]);

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
}
