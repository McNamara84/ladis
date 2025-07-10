<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Password;
use Exception;

class UserManagementControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index_displays_user_management_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/user-management');

        $response->assertStatus(200);
        $response->assertViewIs('user_management');
        $response->assertSee($user->name);
        $response->assertViewHas('users', function ($users) use ($user) {
            return $users->contains('id', $user->id);
        });
    }

    public function test_create_displays_create_user_view(): void
    {
        $response = $this->actingAs(User::factory()->create())->get('/user-management/create');

        $response->assertStatus(200);
        $response->assertViewIs('create_user');
        $response->assertSee(__('Create New Account'));
    }

    public function test_store_creates_user_and_redirects(): void
    {
        $this->actingAs(User::factory()->create());
        $response = $this->withHeader('referer', '/user-management/create')
            ->post('/user-management/create', [
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

    public function test_destroy_deletes_user_and_redirects(): void
    {
        User::factory()->create(['id' => 1]);
        $actingUser = User::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($actingUser)->delete(route('user-management.destroy', $user));

        $response->assertRedirect(route('user-management.index'));
        $this->assertModelMissing($user);
    }

    public function test_admin_user_cannot_be_deleted(): void
    {
        $admin = User::factory()->create(['id' => 1]);

        $response = $this->actingAs(User::factory()->create())->delete(route('user-management.destroy', $admin));

        $response->assertRedirect(route('user-management.index'));
        $response->assertSessionHas('error');
        $this->assertModelExists($admin);
    }

    public function test_store_deletes_user_when_reset_link_fails(): void
    {
        Password::shouldReceive('sendResetLink')
            ->once()
            ->andThrow(new Exception('mail failed'));

        $this->actingAs(User::factory()->create());

        $response = $this->post('/user-management/create', [
            'name' => 'Max Mustermann',
            'email' => 'max.mustermann@fh-potsdam.de',
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('error');
        $this->assertDatabaseMissing('users', [
            'email' => 'max.mustermann@fh-potsdam.de',
        ]);
    }
}
