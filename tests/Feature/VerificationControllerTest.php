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

    public function test_show_displays_verification_view_for_unverified_user(): void
    {
        $user = User::factory()->unverified()->create();

        $response = $this->actingAs($user)->get('/email/verify');

        $response->assertStatus(404);
    }
}
