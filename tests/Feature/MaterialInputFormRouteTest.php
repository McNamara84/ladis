<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class MaterialInputFormRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * This method tests whether a view is displayed whenever the defined route is called.
     */
    public function test_inputform_material_view_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/inputform_material');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_material');
    }

    public function test_inputform_material_view_only_contains_top_level_materials(): void
    {
        $top = \App\Models\Material::create(['name' => 'Top']);
        $child = \App\Models\Material::create(['name' => 'Child', 'parent_id' => $top->id]);

        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/inputform_material');

        $response->assertStatus(200);
        $materials = $response->viewData('materials');
        $this->assertCount(1, $materials);
        $this->assertTrue($materials->contains($top));
        $this->assertFalse($materials->contains($child));
    }
}
