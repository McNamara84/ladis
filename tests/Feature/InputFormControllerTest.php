<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class InputFormControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_inputform_device_view_is_displayed(): void
    {
        $response = $this->get('/inputform');
        
        $response->assertStatus(200);
        $response->assertViewIs('inputform_device');
        $response->assertSee('Neues Lasergerät hinzufügen');
    }
}
