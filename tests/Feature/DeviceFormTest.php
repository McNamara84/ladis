<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Institution;
use App\Models\User;

class DeviceFormTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected Institution $institution;
    protected User $user;

    /**
     * Setup method that runs before each test
     */
    protected function setUp(): void
    {
        parent::setUp();
        
        // Create a test institution and user
        // These will be used for the device creation
        $this->institution = Institution::factory()->create([
            'name' => 'Test Institution',
            'type' => Institution::TYPE_CLIENT, // Auftraggeber
            'contact_information' => 'Kontakt:' . $this->faker->email(),
        ]);
        
        $this->user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com'
        ]);
    }

    public function test_can_store_device_with_valid_data(): void
    {
        $deviceData = [
            'name' => 'CL50-Test',
            'year' => 2023,
            'build' => 0, // Glasfaser
            'description' => 'Test Lasergerät für Unit Tests',
            'height' => 1200,
            'width' => 800,
            'depth' => 600,
            'weight' => 45.50,
            'fiber_length' => 10.00,
            'cooling' => 0, // Intern
            'mounting' => true,
            'automation' => false,
            'max_output' => 100.5,
            'mean_output' => 75.0,
            'max_wattage' => 1500.0,
            'head' => 'Optik OS A20',
            'emission_source' => 0,
            'beam_type' => 0, // Punktlaser
            'beam_profile' => 'Top-Hat-Strahlprofil',
            'wavelength' => 1064.0,
            'min_spot_size' => 0.1,
            'max_spot_size' => 5.0,
            'min_pf' => 1.0,
            'max_pf' => 100.0,
            'min_pw' => 0.5,
            'max_pw' => 50.0,
            'min_scan_width' => 10.0,
            'max_scan_width' => 200.0,
            'min_focal_length' => 50.0,
            'max_focal_length' => 500.0,
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        // Check redirect to index route TODO: Later we redirect to device detail page or the devices table view
        $response->assertRedirect(route('inputform.index'));
        
        // Check Success Message
        $response->assertSessionHas('success');
        $this->assertStringContainsString('CL50-Test', session('success'));

        // Check if device is in database
        $this->assertDatabaseHas('devices', [
            'name' => 'CL50-Test',
            'year' => 2023,
            'build' => 0,
            'beam_type' => 0,
            'institution_id' => 1, // Hardcoded in Controller TODO: Later we get this from form
            'last_edit_by' => 1,   // Hardcoded in Controller TODO: Later we get this from Auth::user()
        ]);

        // Check that exactly one device was created
        $this->assertDatabaseCount('devices', 1);

        // Check values of the created device
        $device = Device::first();
        $this->assertEquals('CL50-Test', $device->name);
        $this->assertEquals(45.50, $device->weight);
        $this->assertEquals(10.00, $device->fiber_length);
        $this->assertTrue($device->mounting);
        $this->assertFalse($device->automation);
    }

    public function test_fails_validation_when_name_is_missing(): void
    {
        $deviceData = [
            // 'name' => 'Test Device', // Missing on purpose
            'beam_type' => 0,
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        // Check redirect and error message
        $response->assertRedirect();
        $response->assertSessionHasErrors(['name']);
        
        // Check if no Devices was created in database
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_fails_validation_when_beam_type_is_missing(): void
    {
        $deviceData = [
            'name' => 'Test Device',
            // 'beam_type' => 0, // Missing on purpose
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['beam_type']);
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_fails_validation_when_device_name_already_exists(): void
    {
        // Create first Device
        Device::factory()->create([
            'name' => 'Unique Device',
            'institution_id' => $this->institution->id,
            'last_edit_by' => $this->user->id,
        ]);

        // Check if another device can be created with the same name
        $deviceData = [
            'name' => 'Unique Device', // Same name as first Device
            'beam_type' => 0,
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['name']);
        
        // Only first Device should be in database
        $this->assertDatabaseCount('devices', 1);
    }
}
