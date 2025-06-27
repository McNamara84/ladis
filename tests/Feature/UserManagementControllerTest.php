<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserManagementControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_displays_user_management_view(): void
    {
        $user = User::factory()->create();

        $response = $this->get('/user-management');

        $response->assertStatus(200);
        $response->assertViewIs('user_management');
        $response->assertSee($user->name);
        $response->assertViewHas('users', function ($users) use ($user) {
            return $users->contains('id', $user->id);
        });
    }

    public function test_create_displays_create_user_view(): void
    {
        $response = $this->get('/user-management/create');

        $response->assertStatus(200);
        $response->assertViewIs('create_user');
        $response->assertSee('Neuen Account erstellen');
    }
}
