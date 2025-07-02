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
}
