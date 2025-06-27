<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('register', [RegisterController::class, 'showRegistrationForm'])
            ->middleware(['web', 'guest'])
            ->name('register');

        Route::post('register', [RegisterController::class, 'register'])
            ->middleware(['web', 'guest']);

        Route::getRoutes()->refreshNameLookups();
    }

    public function test_registration_form_is_displayed(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(200);
        $response->assertViewIs('auth.register');
        $response->assertSee('Registrierung');
    }

    public function test_user_can_register_with_valid_data(): void
    {
        $response = $this->post('/register', [
            'name' => 'Max Mustermann',
            'email' => 'max.mustermann@fh-potsdam.de',
            'password' => 'StrengGeheim!',
            'password_confirmation' => 'StrengGeheim!'
        ]);

        $response->assertRedirect('/home');

        $user = User::where('email', 'max.mustermann@fh-potsdam.de')->first();
        $this->assertNotNull($user);
        $this->assertAuthenticatedAs($user);
    }

    public function test_user_cannot_register_with_invalid_data(): void
    {
        $response = $this->from('/register')->post('/register', [
            'name' => '',
            'email' => 'invalid-email',
            'password' => 'short',
            'password_confirmation' => 'different'
        ]);

        $response->assertRedirect('/register');
        $response->assertSessionHasErrors(['name', 'email', 'password']);
        $this->assertGuest();
        $this->assertDatabaseCount('users', 0);
    }
}
