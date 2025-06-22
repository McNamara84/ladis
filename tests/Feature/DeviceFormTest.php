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

    public function test_fails_validation_with_invalid_enum_values(): void
    {
        $deviceData = [
            'name' => 'Test Device',
            'build' => 99,      // Unallowed value (only 0,1 allowed)
            'beam_type' => 99,  // Unallowed value (only 0,1,2 allowed)
            'cooling' => 99,    // Unallowed value (only 0,1 allowed)
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['build', 'beam_type', 'cooling']);

        // Check if no DDevices with unallowed values were created
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_fails_validation_with_negative_values(): void
    {
        $deviceData = [
            'name' => 'Test Device',
            'beam_type' => 0,
            'year' => 1800,         // To low
            'height' => -100,       // signed
            'width' => -50,         // signed
            'weight' => -10.5,      // signed
            'fiber_length' => -5.0, // signed
            'max_output' => -100,   // signed
            'wavelength' => -1064,  // signed
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect();
        $response->assertSessionHasErrors([
            'year', 'height', 'width', 'weight', 
            'fiber_length', 'max_output', 'wavelength'
        ]);
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_fails_validation_with_too_long_strings(): void
    {
        $deviceData = [
            'name' => str_repeat('A', 51),           // Max. 50 chars
            'head' => str_repeat('B', 51),           // Max. 50 chars
            'beam_profile' => str_repeat('C', 51),   // Max. 50 chars
            'beam_type' => 0,
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect();
        $response->assertSessionHasErrors(['name', 'head', 'beam_profile']);
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_accepts_boundary_values(): void
    {
        $deviceData = [
            'name' => 'Boundary Test',
            'year' => 1900,     // Min. allowed
            'weight' => 999.99, // Max. allowed (decimal(5,2))
            'beam_type' => 2,   // Max. allowed
            'build' => 1,       // Max. allowed
            'cooling' => 1,     // Max. allowed
            'height' => 1,      // Min. > 0
            'width' => 999999,  // Large value, but should be valid
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect(route('inputform.index'));
        $response->assertSessionHas('success');
        $this->assertDatabaseCount('devices', 1);
        
        $device = Device::first();
        $this->assertEquals(1900, $device->year);
        $this->assertEquals(999.99, $device->weight);
    }

    public function test_can_store_device_with_minimum_required_fields(): void
    {
        $deviceData = [
            'name' => 'Minimal Device', // Reuqired field
            'beam_type' => 1,           // Required field
        ];

        $response = $this->post(route('inputform.store'), $deviceData);

        $response->assertRedirect(route('inputform.index'));
        $response->assertSessionHas('success');
        
        $this->assertDatabaseHas('devices', [
            'name' => 'Minimal Device',
            'beam_type' => 1,
        ]);
        
        $device = Device::first();
        $this->assertNull($device->year);
        $this->assertNull($device->weight);
        $this->assertNull($device->description);
    }

    public function test_boolean_fields_are_processed_correctly(): void
    {
        // Test case with mounting=true, automation=false
        $deviceData = [
            'name' => 'Boolean Test 1',
            'beam_type' => 0,
            'mounting' => 1,    // true
            'automation' => 0,  // false
        ];

        $response = $this->post(route('inputform.store'), $deviceData);
        $response->assertRedirect(route('inputform.index'));

        $device = Device::where('name', 'Boolean Test 1')->first();
        $this->assertTrue($device->mounting);
        $this->assertFalse($device->automation);

        // Test case with mounting=false, automation=true
        $deviceData2 = [
            'name' => 'Boolean Test 2', 
            'beam_type' => 0,
            'mounting' => 0,    // false
            'automation' => 1,  // true
        ];

        $this->post(route('inputform.store'), $deviceData2);

        $device2 = Device::where('name', 'Boolean Test 2')->first();
        $this->assertFalse($device2->mounting);
        $this->assertTrue($device2->automation);
    }

    public function test_can_view_input_form(): void
    {
        $response = $this->get(route('inputform.index'));

        $response->assertStatus(200);
        $response->assertViewIs('inputform_device');
        $response->assertSee('Neues Lasergerät hinzufügen');
    }
}
