<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Material;
use App\Models\User;

class MaterialInputFormValidationTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_store_creates_material_and_redirects(): void
    {
        $name = 'Stein';

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => $name,
            ]);

        $response->assertRedirect('/inputform_material');
        $this->assertDatabaseHas('materials', [
            'name' => $name,
        ]);

        $material = Material::where('name', $name)->first();
        $this->assertNotNull($material);
    }

    public function test_store_does_not_create_material_and_redirects(): void
    {
        $name_non = '';

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => $name_non,
            ]);

        $response->assertRedirect('/inputform_material');
        $response->assertSessionHasErrors('material_name');
        $this->assertDatabaseMissing('materials', [
            'name' => $name_non,
        ]);
    }

    public function test_store_checks_valid_input(): void
    {
        $name_non_valid = 'BeispielstringBeispielstringBeispielstringBeispiels';

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => $name_non_valid,
            ]);
        $response->assertRedirect('/inputform_material');
        $response->assertSessionHasErrors('material_name');
        $this->assertDatabaseMissing('materials', [
            'name' => $name_non_valid,
        ]);
    }

    public function test_required_data_is_missing_material_and_redirects(): void
    {
        $name_non = null;

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => $name_non,
            ]);

        $response->assertRedirect('/inputform_material');
        $response->assertSessionHasErrors('material_name');
    }

    public function test_store_rejects_non_top_level_parent(): void
    {
        $top = Material::create(['name' => 'Top']);
        $child = Material::create(['name' => 'Child', 'parent_id' => $top->id]);

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => 'Third',
                'material_parent_id' => $child->id,
            ]);

        $response->assertRedirect('/inputform_material');
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('materials', ['name' => 'Third']);
    }
}
