<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Institution;
use App\Models\User;

class DeviceListTest extends TestCase
{
    use RefreshDatabase;

    public function test_devices_list_page_displays_devices(): void
    {
        $institution = Institution::factory()->create();
        Device::factory()->count(2)->create(['institution_id' => $institution->id]);

        $response = $this->get('/devices/all');

        $response->assertStatus(200);
        $response->assertViewIs('devices.index');
        $response->assertViewHas('devices');
    }

    public function test_device_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $institution = Institution::factory()->create();
        $device = Device::factory()->create(['institution_id' => $institution->id]);

        $response = $this->actingAs($user)->delete(route('devices.destroy', $device));

        $response->assertRedirect(route('devices.all'));
        $this->assertModelMissing($device);
    }

    public function test_guest_cannot_delete_device(): void
    {
        $device = Device::factory()->create(['institution_id' => Institution::factory()->create()->id]);

        $response = $this->delete(route('devices.destroy', $device));

        $response->assertRedirect('/login');
        $this->assertModelExists($device);
    }
}
