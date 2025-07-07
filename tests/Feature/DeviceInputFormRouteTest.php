<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeviceInputFormRouteTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_inputform_route_returns_successful_response(): void
    {
        $response = $this->get('/inputform');

        $response->assertStatus(200);
    }
}
