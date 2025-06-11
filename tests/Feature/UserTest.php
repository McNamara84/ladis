<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fillable_attributes(): void
    {
        $user = new User();
        $this->assertSame(['name', 'email', 'password'], $user->getFillable());
    }
}
