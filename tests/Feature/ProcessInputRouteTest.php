<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ProcessInputRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_inputform_process_view_is_displayed(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get('/inputform_process');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_process');
        $response->assertViewHas('pageTitle', 'Prozesseingabe');
        $response->assertViewHas('partialSurfaces');
    }
}
