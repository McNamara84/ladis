<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputFormDeviceControllerTest extends TestCase
{
    public function test_inputform_device_view_requires_authentication(): void
    {
        $response = $this->get('/devices/create');

        $response->assertRedirect('/login');
    }
}
