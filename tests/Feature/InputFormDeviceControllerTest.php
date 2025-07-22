<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\User;

class InputFormDeviceControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_inputform_device_view_requires_authentication(): void
    {
        $response = $this->get('/devices/create');

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_device(): void
    {
        $data = [
            'name' => 'Guest Device',
            'beam_type' => Device::BEAM_POINT,
        ];

        $response = $this->post('/devices/create', $data);

        $response->assertRedirect('/login');
        $this->assertDatabaseCount('devices', 0);
    }

    public function test_index_passes_page_title_to_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/devices/create');

        $response->assertStatus(200);
        $response->assertViewHas('pageTitle', 'Input Form - LADIS - FH Potsdam');
    }
}
