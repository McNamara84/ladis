<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    public function test_fillable_attributes(): void
    {
        $user = new User();
        $this->assertSame(['name', 'email', 'password'], $user->getFillable());
    }

    public function test_hidden_attributes_are_hidden_from_array(): void
    {
        $user = new User(['password' => 'secret', 'remember_token' => 'token']);

        $this->assertSame(['password', 'remember_token'], $user->getHidden());
        $array = $user->toArray();
        $this->assertArrayNotHasKey('password', $array);
        $this->assertArrayNotHasKey('remember_token', $array);
    }
}
