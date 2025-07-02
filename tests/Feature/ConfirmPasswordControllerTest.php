<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\ConfirmPasswordController;
use Illuminate\Support\Facades\Hash;

class ConfirmPasswordControllerTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();

        Route::get('password/confirm', [ConfirmPasswordController::class, 'showConfirmForm'])
            ->middleware(['web', 'auth'])
            ->name('password.confirm');

        Route::post('password/confirm', [ConfirmPasswordController::class, 'confirm'])
            ->middleware(['web', 'auth']);

        Route::getRoutes()->refreshNameLookups();
    }

    public function test_show_confirm_form_displays_view(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/password/confirm');

        $response->assertStatus(200);
        $response->assertViewIs('auth.passwords.confirm');
        $response->assertSee('Confirm Password');
    }

    public function test_confirm_with_valid_password_redirects_to_home(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('StrengGeheim!'), # ggignore
        ]);

        $response = $this->actingAs($user)->post('/password/confirm', [
            'password' => 'StrengGeheim!', # ggignore
        ]);

        $response->assertRedirect('/home');
        $this->assertNotNull(session('auth.password_confirmed_at'));
    }

    public function test_confirm_with_invalid_password_redirects_back_with_errors(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('secret'), # ggignore
        ]);

        $response = $this->actingAs($user)
            ->from('/password/confirm')
            ->post('/password/confirm', [
                'password' => 'wrong-password', # ggignore
            ]);

        $response->assertRedirect('/password/confirm');
        $response->assertSessionHasErrors('password');
        $this->assertNull(session('auth.password_confirmed_at'));
    }
}
