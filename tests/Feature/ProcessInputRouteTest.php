<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Device;
use App\Models\Configuration;

class ProcessInputRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_inputform_process_view_is_displayed(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/inputform_process');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_process');
        $response->assertViewHas('pageTitle', 'Prozesseingabe');
        $response->assertViewHas('partialSurfaces');
    }

    public function test_inputform_process_view_includes_devices_and_configurations(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $device = Device::factory()->create();
        $configuration = Configuration::factory()->create();

        $response = $this->get('/inputform_process');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_process');
        $response->assertViewHas('devices', function ($devices) use ($device) {
            return $devices->contains($device);
        });
        $response->assertViewHas('configurations', function ($configs) use ($configuration) {
            return $configs->contains($configuration);
        });
    }
}
