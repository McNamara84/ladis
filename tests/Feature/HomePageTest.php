<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_view_requires_authentication(): void
    {
        $response = $this->get('/home');

        $response->assertRedirect('/login');
    }

    public function test_authenticated_user_can_view_home_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/home');

        $response->assertStatus(200);
        $response->assertViewIs('home');
        $response->assertViewHas('appVersion', config('app.version'));
        $response->assertSee($user->name);
    }
}
