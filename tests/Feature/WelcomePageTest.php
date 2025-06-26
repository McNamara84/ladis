<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use App\Models\Device;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_welcome_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_welcome_page_uses_welcome_view(): void
    {
        $response = $this->get('/');

        $response->assertViewIs('welcome');
    }

    public function test_welcome_page_displays_application_name(): void
    {
        $response = $this->get('/');

        $response->assertSee(config('app.name'));
    }

    public function test_welcome_page_displays_device_count(): void
    {
        $institution = Institution::create([
            'name' => 'Fachhocschule Potsdam',
            'type' => Institution::TYPE_CONTRACTOR,
            'contact_information' => 'test@fh-potsdam.de',
        ]);

        $device = new Device();
        $device->institution_id = $institution->id;
        $device->name = 'Test-Lasergerät';
        $device->beam_type = Device::BEAM_POINT;
        $device->save();

        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertViewIs('welcome');
        $response->assertViewHas('deviceCount', 1);
    }
}
