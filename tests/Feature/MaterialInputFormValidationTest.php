<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Material;

class MaterialInputFormValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_store_creates_material_and_redirects(): void
    {
        $name = 'Stein';

        $response = $this->withHeader('referer', '/inputform_material')
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

        $response = $this->withHeader('referer', '/inputform_material')
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

        $response = $this->withHeader('referer', '/inputform_material')
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

        $response = $this->withHeader('referer', '/inputform_material')
            ->post('/inputform_material', [
                'material_name' => $name_non,
            ]);

        $response->assertRedirect('/inputform_material');
        $response->assertSessionHasErrors('material_name');
    }
}