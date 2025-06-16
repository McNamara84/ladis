<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputFormRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function inputform_route_returns_successful_response(): void
    {
        $response = $this->get('/inputform');

        $response->assertStatus(200);
    }
}
