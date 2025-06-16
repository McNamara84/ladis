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
    public function test_input_form_view_is_displayed(): void
    {
        $response = $this->get('/input_form');
        
        $response->assertStatus(200);
        $response->assertViewIs('input_form');
        $response->assertSee('Input Form - Laser-Projekt - FH Potsdam');
    }
}
