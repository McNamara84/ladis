<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialFormRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_inputform_material_view_is_displayed(): void
    {
        $response = $this->get('xxx/');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_material');
        }
}
