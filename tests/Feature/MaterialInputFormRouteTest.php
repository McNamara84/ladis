<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
//use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MaterialInputFormRouteTest extends TestCase
{

    use RefreshDatabase;
    /**
     * This method tests whether a view is displayed whenever the defined route is called.
     */
    public function test_inputform_material_view_is_displayed(): void
    {
        $response = $this->get('/inputform_material');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_material');
    }
}
