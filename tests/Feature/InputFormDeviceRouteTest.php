<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputFormDeviceRouteTest extends TestCase
{
    public function test_inputform_route_returns_successful_response(): void
    {
        $response = $this->get('/devices/create');

        $response->assertStatus(200);
    }
}
