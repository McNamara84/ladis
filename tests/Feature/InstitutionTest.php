<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Institution;
use App\Models\Device;

class InstitutionTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Tests whether the getTypes() method from the Institution model
     * correctly returns the expected values used as enums for material types.
     */
    public function test_get_types_returns_all_expected_values(): void
    {
        $expected = [
            Institution::TYPE_CLIENT,
            Institution::TYPE_CONTRACTOR,
            Institution::TYPE_MANUFACTURER,
        ];

        $this->assertEquals($expected, Institution::getTypes());
    }

    /**
     * Tests if devices belonging to the institution are returned.
     */
    public function test_devices_relationship_returns_devices(): void
    {
        $institution = Institution::create([
            'name' => 'Foo',
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'bar',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'Laser';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $this->assertTrue($institution->devices->contains($device));
    }
}
