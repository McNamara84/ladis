<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Artifact;
use App\Models\SampleSurface;
use App\Models\PartialSurface;
use App\Models\Material;
use App\Models\Condition;

class SampleSurfaceManagementTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_can_view_sample_surface_overview(): void
    {
        $surfaces = SampleSurface::factory()->count(2)->create();

        $this->get(route('sample_surfaces.all'))
            ->assertOk()
            ->assertSee($surfaces->first()->name)
            ->assertSee($surfaces->last()->name);
    }

    public function test_public_can_view_partial_surface_overview(): void
    {
        $partialSurface = PartialSurface::factory()->create();

        $this->get(route('partial_surfaces.all'))
            ->assertOk()
            ->assertSee((string) $partialSurface->identifier);
    }

    public function test_guest_cannot_access_sample_surface_create_form(): void
    {
        $this->get(route('sample_surfaces.create'))->assertRedirectToRoute('login');
    }

    public function test_guest_cannot_access_partial_surface_create_form(): void
    {
        $this->get(route('partial_surfaces.create'))->assertRedirectToRoute('login');
    }

    public function test_authenticated_user_can_view_sample_surface_create_form(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('sample_surfaces.create'))
            ->assertOk()
            ->assertSee('Neue Probenfläche anlegen');
    }

    public function test_authenticated_user_can_view_partial_surface_create_form(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('partial_surfaces.create'))
            ->assertOk()
            ->assertSee('Neue Teilfläche anlegen');
    }

    public function test_creating_sample_surface_requires_valid_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('sample_surfaces.create'))
            ->post(route('sample_surfaces.store'), [])
            ->assertRedirect(route('sample_surfaces.create'))
            ->assertSessionHasErrors(['artifacts_id', 'name', 'description']);
    }

    public function test_creating_partial_surface_requires_valid_data(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->from(route('partial_surfaces.create'))
            ->post(route('partial_surfaces.store'), [])
            ->assertRedirect(route('partial_surfaces.create'))
            ->assertSessionHasErrors([
                'sample_surface_id',
                'foundation_material_id',
                'coating_material_id',
                'condition_id',
                'result_id',
                'size',
            ]);
    }

    public function test_authenticated_user_can_create_sample_surface(): void
    {
        $user = User::factory()->create();
        $artifact = Artifact::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('sample_surfaces.store'), [
                'artifacts_id' => $artifact->id,
                'name' => 'Probe 01',
                'description' => 'Beschreibung der Probenfläche.',
            ]);

        $response->assertRedirect(route('sample_surfaces.all'));
        $this->assertDatabaseHas('sample_surfaces', [
            'name' => 'Probe 01',
            'artifacts_id' => $artifact->id,
        ]);
    }

    public function test_authenticated_user_can_create_partial_surface(): void
    {
        $user = User::factory()->create();
        $sampleSurface = SampleSurface::factory()->create();
        $foundation = Material::factory()->create();
        $coating = Material::factory()->create();
        $condition = Condition::factory()->create();
        $result = Condition::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('partial_surfaces.store'), [
                'sample_surface_id' => $sampleSurface->id,
                'foundation_material_id' => $foundation->id,
                'coating_material_id' => $coating->id,
                'condition_id' => $condition->id,
                'result_id' => $result->id,
                'identifier' => 'TF-01',
                'size' => '12.50',
            ]);

        $response->assertRedirect(route('partial_surfaces.all'));
        $this->assertDatabaseHas('partial_surfaces', [
            'sample_surface_id' => $sampleSurface->id,
            'identifier' => 'TF-01',
        ]);
    }

    public function test_authenticated_user_can_delete_sample_surface(): void
    {
        $user = User::factory()->create();
        $sampleSurface = SampleSurface::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('sample_surfaces.destroy', $sampleSurface));

        $response->assertRedirect(route('sample_surfaces.all'));
        $this->assertDatabaseMissing('sample_surfaces', [
            'id' => $sampleSurface->id,
        ]);
    }

    public function test_authenticated_user_can_delete_partial_surface(): void
    {
        $user = User::factory()->create();
        $partialSurface = PartialSurface::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('partial_surfaces.destroy', $partialSurface));

        $response->assertRedirect(route('partial_surfaces.all'));
        $this->assertDatabaseMissing('partial_surfaces', [
            'id' => $partialSurface->id,
        ]);
    }
}
