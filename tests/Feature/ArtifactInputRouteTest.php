<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class ArtifactInputRouteTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_artifact_input_route_returns_successful_response(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $response = $this->get('/inputform_artifact');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_artifact');
    }
}
