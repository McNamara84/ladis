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
     * correctly returns the expected values used as enums for institution types.
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
            'name' => 'Laser Tec Inc.',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'callme',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'Laser';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $this->assertTrue($institution->devices->contains($device));
    }

    /**
     * Test that database enforces unique name constraint
     */
    public function test_database_enforces_unique_name_constraint(): void
    {
        $name = 'Test Institution';
        Institution::factory()->create(['name' => $name]);

        // Attempting to create another institution with the same name should fail
        $this->expectException(\Illuminate\Database\QueryException::class);
        Institution::factory()->create(['name' => $name]);
    }
}
