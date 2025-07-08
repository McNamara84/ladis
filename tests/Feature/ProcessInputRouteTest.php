<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProcessInputRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_inputform_process_view_is_displayed(): void
    {
        $response = $this->get('/inputform_process');

        $response->assertStatus(200);
    }
}
