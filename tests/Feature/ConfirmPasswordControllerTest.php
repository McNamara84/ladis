<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\Auth\ConfirmPasswordController;

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
}
