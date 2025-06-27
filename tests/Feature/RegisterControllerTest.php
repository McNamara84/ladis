<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;

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
}
