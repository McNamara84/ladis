<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class DeviceInputControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_inputform_device_view_is_displayed(): void
    {
        // Simulate a user being authenticated
        $this->actingAs(User::factory()->create());

        $response = $this->get('/inputform');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_device');
        $response->assertSee('Neues Lasergerät hinzufügen');
    }
}
