<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Material;
use Exception;

class MaterialInputControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Material::flushEventListeners();
        Material::clearBootedModels();
        parent::tearDown();
    }

    public function test_store_creates_material_with_parent_and_redirects(): void
    {
        $parent = Material::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->withHeader('referer', '/materials/create')
            ->post('/materials/create', [
                'material_name' => 'Child',
                'material_parent_id' => $parent->id,
            ]);

        $response->assertRedirect('/materials/all');
        $this->assertDatabaseHas('materials', [
            'name' => 'Child',
            'parent_id' => $parent->id,
        ]);
    }

    public function test_store_handles_exception_and_redirects_back(): void
    {
        $user = User::factory()->create();

        Material::creating(function () {
            throw new Exception('fail');
        });

        $response = $this->actingAs($user)
            ->withHeader('referer', '/materials/create')
            ->post('/materials/create', [
                'material_name' => 'Stone',
            ]);

        $response->assertRedirect('/materials/create');
        $response->assertSessionHas('error');
    }
}
