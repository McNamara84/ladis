<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\Events\PasswordReset;

class AppServiceProviderTest extends TestCase
{
    use RefreshDatabase;

    public function test_password_reset_marks_unverified_email_as_verified(): void
    {
        $user = User::factory()->unverified()->create();

        event(new PasswordReset($user));
        $user->refresh();

        $this->assertNotNull($user->email_verified_at);
    }

    public function test_password_reset_does_not_change_already_verified_email(): void
    {
        $user = User::factory()->create();
        $verifiedAt = $user->email_verified_at;

        event(new PasswordReset($user));
        $user->refresh();

        $this->assertEquals($verifiedAt, $user->email_verified_at);
    }
}
