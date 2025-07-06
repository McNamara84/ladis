<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InputFormInstitutionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        $response = $this->get('/inputform_institution');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_institution');


    }
