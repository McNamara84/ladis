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
}
