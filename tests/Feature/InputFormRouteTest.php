<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class InputFormRouteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_inputform_route_returns_successful_response(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/inputform');

        $response->assertStatus(200);
    }
}
