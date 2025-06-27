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

    public function test_store_creates_user_and_redirects(): void
    {
        $response = $this->post('/user-management/create', [
            'name' => 'Max Mustermann',
            'email' => 'max.mustermann@fh-potsdam.de',
        ]);

        $response->assertRedirect(route('user-management.index'));
        $this->assertDatabaseHas('users', [
            'name' => 'Max Mustermann',
            'email' => 'max.mustermann@fh-potsdam.de',
        ]);

        $user = User::where('email', 'max.mustermann@fh-potsdam.de')->first();
        $this->assertNotNull($user->password);
    }
}
