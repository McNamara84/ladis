<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Material;
use App\Models\User;

class MaterialListTest extends TestCase
{
    use RefreshDatabase;

    public function test_materials_list_page_displays_materials(): void
    {
        Material::factory()->count(2)->create();

        $response = $this->get('/materials/all');

        $response->assertStatus(200);
        $response->assertViewIs('materials.index');
        $response->assertViewHas('materials');
    }

    public function test_material_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $material = Material::factory()->create();

        $response = $this->actingAs($user)->delete(route('materials.destroy', $material));

        $response->assertRedirect(route('materials.all'));
        $this->assertModelMissing($material);
    }
}
