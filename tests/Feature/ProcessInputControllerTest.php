<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PartialSurface;
use App\Models\Device;
use App\Models\Configuration;
use App\Models\Artifact;
use App\Models\SampleSurface;
use App\Models\DamagePattern;
use App\Models\Condition;
use App\Models\Material;
use App\Models\Lens;


class ProcessInputControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_form_can_not_be_saved(): void
    {
        $response = $this->post('/inputform_process', [
            'partial_surface_id' => '',
            'device_id' => '',
            'configuration_id' => '',
            'description' => '',
            'duration' => '',
            'wet' => '',
        ]);

        $response->assertSessionHasErrors([
            'partial_surface_id',
            'device_id',
            'configuration_id',
            'duration',
            'wet',
        ]);
    }

    public function test_store_creates_process_and_redirects(): void
    {
        $artifact = Artifact::factory()->create();
        $sampleSurface = SampleSurface::unguarded(callback: fn (): SampleSurface => SampleSurface::create(attributes: [
            'name' => 'Test',
            'description' => 'desc',
            'artifacts_id' => $artifact->id,

        ]));
        $damagePattern = DamagePattern::factory()->create();
        $condition = Condition::create(attributes:['damage_pattern_id' => $damagePattern->id]);
        $result = Condition::create(attributes: ['damage_pattern_id' => $damagePattern->id]);
        $foundation = Material::factory()->create();
        $coating = Material::factory()->create();
        $partialSurface = PartialSurface::create(attributes: [
            'sample_surface_id' => $sampleSurface->id,
            'foundation_material_id' => $foundation->id,
            'coating_material_id' => $coating->id,
            'condition_id' => $condition->id,
            'result_id' => $result->id,
            'identifier' => 'PS1',
            'size' => 1.0,
        ]);
        $device = Device::factory()->create();
        $lens = Lens::factory()->create();
        $configuration = Configuration::factory()->create(['lens_id' => $lens->id]);

        $data = [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            'description' => 'Test Prozess',
            'duration' => 1,
            'wet' => 0,
        ];
        $response = $this->withHeader(name: 'referer', value: '/inputform_process')
            ->post(uri: '/inputform_process', data: $data);
        
        $response->assertRedirect(uri: 'inputform_process');
        $this->assertDatabaseHas(table: 'processes', data: [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            'description' => 'Test Prozess',
            'duration' => 1,
            'wet' => 0,
        ]);
    }
}