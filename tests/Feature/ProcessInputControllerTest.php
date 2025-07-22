<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PartialSurface;
use App\Models\Device;
use App\Models\Configuration;
use App\Models\SampleSurface;
use App\Models\DamagePattern;
use App\Models\Condition;
use App\Models\Material;
use App\Models\Lens;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use App\Models\Process;

class ProcessInputControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_form_can_not_be_saved(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
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
        $user = User::factory()->create();
        $this->actingAs($user);

        $sampleSurface = SampleSurface::factory()->create();
        $damagePattern = DamagePattern::factory()->create();
        $condition = Condition::factory()->for($damagePattern)->create();
        $result = Condition::factory()->for($damagePattern)->create();
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

    public function test_store_fails_when_required_field_is_missing(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $sampleSurface = SampleSurface::factory()->create();
        $damagePattern = DamagePattern::factory()->create();
        $condition = Condition::factory()->for($damagePattern)->create();
        $result = Condition::factory()->for($damagePattern)->create();
        $foundation = Material::factory()->create();
        $coating = Material::factory()->create();
        $partialSurface = PartialSurface::create([
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
            //'duration' => 1,  // Duration is missing
            'wet' => 0,
            'description' => '',
        ];

        $response = $this->withHeader(name: 'referer', value: '/inputform_process')
            ->post(uri: '/inputform_process', data: $data);

        $response->assertRedirect(uri: '/inputform_process');
        $response->assertSessionHasErrors('duration');
        $this->assertDatabaseMissing('processes', [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            //'duration' => 1,  // Duration is missing
            'wet' => 0,
        ]);
    }

    public function test_store_fails_with_invalid_foreign_keys(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'partial_surface_id' => 999,
            'device_id' => 999,
            'configuration_id' => 999,
            'description' => 'Invalid',
            'duration' => 1,
            'wet' => 1,
        ];

        $response = $this->withHeader('referer', '/inputform_process')
            ->post('/inputform_process', $data);

        $response->assertRedirect('/inputform_process');
        $response->assertSessionHasErrors([
            'partial_surface_id',
            'device_id',
            'configuration_id',
        ]);
        $this->assertDatabaseCount('processes', 0);
    }

    public function test_index_displays_all_needed_data(): void
    {
        $user = User::factory()->create();
        $partialSurface = PartialSurface::factory()->create();
        $device = Device::factory()->create();
        $lens = Lens::factory()->create();
        $configuration = Configuration::factory()->create(['lens_id' => $lens->id]);

        $response = $this->actingAs($user)->get('/inputform_process');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_process');
        $response->assertViewHas('pageTitle', 'Prozesseingabe');
        $response->assertViewHas('partialSurfaces', function ($surfaces) use ($partialSurface) {
            return $surfaces->contains($partialSurface);
        });
        $response->assertViewHas('devices', function ($devices) use ($device) {
            return $devices->contains($device);
        });
        $response->assertViewHas('configurations', function ($configs) use ($configuration) {
            return $configs->contains($configuration);
        });
    }

    public function test_store_creates_process_without_description(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $partialSurface = PartialSurface::factory()->create();
        $device = Device::factory()->create();
        $lens = Lens::factory()->create();
        $configuration = Configuration::factory()->create(['lens_id' => $lens->id]);

        $data = [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            'description' => '',
            'duration' => 2,
            'wet' => 1,
        ];

        $response = $this->withHeader('referer', '/inputform_process')
            ->post('/inputform_process', $data);

        $response->assertRedirect('/inputform_process');
        $response->assertSessionHas('success');
        $this->assertDatabaseHas('processes', [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            'description' => null,
            'duration' => 2,
            'wet' => 1,
        ]);
    }

    public function test_store_fails_with_invalid_ids_and_values(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $data = [
            'partial_surface_id' => 999,
            'device_id' => 999,
            'configuration_id' => 999,
            'description' => 'Bad',
            'duration' => 99,
            'wet' => 2,
        ];

        $response = $this->withHeader('referer', '/inputform_process')
            ->post('/inputform_process', $data);

        $response->assertRedirect('/inputform_process');
        $response->assertSessionHasErrors([
            'partial_surface_id',
            'device_id',
            'configuration_id',
            'duration',
            'wet',
        ]);
        $this->assertDatabaseCount('processes', 0);
    }

    public function test_store_handles_exception_and_redirects_with_error(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $partialSurface = PartialSurface::factory()->create();
        $device = Device::factory()->create();
        $lens = Lens::factory()->create();
        $configuration = Configuration::factory()->create(['lens_id' => $lens->id]);

        Event::listen('eloquent.creating: '.Process::class, function () {
            throw new \Exception('fail');
        });

        $data = [
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $configuration->id,
            'description' => 'err',
            'duration' => 1,
            'wet' => 0,
        ];

        $response = $this->withHeader('referer', '/inputform_process')
            ->post('/inputform_process', $data);

        $response->assertRedirect('/inputform_process');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('processes', 0);

        Event::forget('eloquent.creating: '.Process::class);
    }
}