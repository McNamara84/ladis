<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Device;

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

    public function test_edited_devices_relationship(): void
    {
        $user = new User();
        $relation = $user->editedDevices();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Device::class, $relation->getRelated());
        $this->assertEquals('last_edit_by', $relation->getForeignKeyName());
    }
}
