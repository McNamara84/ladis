<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class InputFormControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_inputform_device_view_is_displayed(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/inputform');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_device');
        $response->assertSee('Neues Lasergerät hinzufügen');
    }
}
