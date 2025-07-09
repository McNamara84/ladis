<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class DeviceInputFormRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_inputform_route_returns_successful_response(): void
    {
        // Simulate a user being authenticated
        $this->actingAs(User::factory()->create());
        $response = $this->get('/inputform');

        $response->assertStatus(200);
    }
}
