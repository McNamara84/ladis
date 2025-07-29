<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;

class DeviceFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $device = Device::factory()->create();

        $this->assertInstanceOf(Device::class, $device);
        $this->assertDatabaseHas('devices', ['id' => $device->id]);
    }
}
