<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class UserFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $user = User::factory()->create();

        $this->assertInstanceOf(User::class, $user);
        $this->assertDatabaseHas('users', ['id' => $user->id]);
    }
}
