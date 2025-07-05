<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Institution;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_result_page_returns_successful_response(): void
    {
        $response = $this->get('/adv-search/result');

        $response->assertStatus(200);
        $response->assertViewIs('search.index');
    }

    public function test_search_returns_device_name(): void
    {
        $institution = Institution::create([
            'name' => 'Fachhochschule Potsdam',
            'type' => Institution::TYPE_CONTRACTOR,
            'contact_information' => 'test@fh-potsdam.de',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'CL50';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $response = $this->get('/adv-search/result?q=CL50');

        $response->assertStatus(200);
        $response->assertSee('CL50');
    }

    public function test_search_returns_by_institution_name(): void
    {
        $institution = Institution::create([
            'name' => 'Laser Lab',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info@laser.lab',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'UniMax';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $response = $this->get('/adv-search/result?q=Laser');

        $response->assertStatus(200);
        $response->assertSee('UniMax');
    }

    public function test_advanced_search_returns_by_institution_name(): void
    {
        $institution = Institution::create([
            'name' => 'Däßler Center',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info@daessler-laser.de',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'SuperLaser';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $response = $this->get('/adv-search/result?advanced=1&institution_id=Däßler');

        $response->assertStatus(200);
        $response->assertSee('SuperLaser');
    }

    public function test_advanced_search_returns_by_device_name(): void
    {
        $institution = Institution::create([
            'name' => 'Däßler Center',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info@daessler-laser.de',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'CL60';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $response = $this->get('/adv-search/result?advanced=1&q=CL60');

        $response->assertStatus(200);
        $response->assertSee('CL60');
    }

    public function test_advanced_search_filters_by_device_and_institution(): void
    {
        $inst1 = Institution::create([
            'name' => 'Tech Lab',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info@techlab.de',
        ]);

        $inst2 = Institution::create([
            'name' => 'Other Lab',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info@otherlab.de',
        ]);

        $device1 = new Device();
        $device1->institution_id = $inst1->id;
        $device1->name = 'Advanced2000';
        $device1->beam_type = Device::BEAM_POINT;
        $device1->save();

        $device2 = new Device();
        $device2->institution_id = $inst2->id;
        $device2->name = 'OtherDevice';
        $device2->beam_type = Device::BEAM_POINT;
        $device2->save();

        $response = $this->get('/adv-search/result?advanced=1&q=Advanced2000&institution_id=Tech');

        $response->assertStatus(200);
        $response->assertSee('Advanced2000');
        $response->assertDontSee('OtherDevice');
    }

    public function test_simple_search_with_empty_query_displays_no_results(): void
    {
        $response = $this->get('/adv-search/result?q=');

        $response->assertStatus(200);
        $response->assertSee('Keine Ergebnisse gefunden.');
    }

    public function test_advanced_search_with_empty_fields_displays_no_results(): void
    {
        $response = $this->get('/adv-search/result?advanced=1');

        $response->assertStatus(200);
        $response->assertSee('Keine Ergebnisse gefunden.');
    }
}
