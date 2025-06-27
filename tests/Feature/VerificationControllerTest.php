<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Models\User;
use Illuminate\Support\Facades\URL;

class VerificationControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Route::get('email/verify', [VerificationController::class, 'show'])
            ->middleware(['web', 'auth'])
            ->name('verification.notice');

        Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verify'])
            ->middleware(['web', 'auth', 'signed'])
            ->name('verification.verify');

        Route::post('email/resend', [VerificationController::class, 'resend'])
            ->middleware(['web', 'auth'])
            ->name('verification.resend');

        Route::getRoutes()->refreshNameLookups();
    }

    public function test_show_displays_verification_view_for_unverified_user(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertStatus(200);
        $response->assertViewIs('auth.verify');
        $response->assertSee('Verify Your Email Address');
    }

    public function test_show_redirects_verified_user_to_home(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertRedirect('/home');
    }

    public function test_verify_marks_user_email_as_verified_and_redirects_home(): void
    {
        $user = User::factory()->unverified()->create();

        $url = URL::temporarySignedRoute(
            'verification.verify',
            now()->addMinutes(60),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        $response = $this->actingAs($user)->get($url);

        $response->assertRedirect('/home');
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }
}
