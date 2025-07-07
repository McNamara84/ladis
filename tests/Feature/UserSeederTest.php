<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test whether the BOT user has been created after calling the seeder.
     */
    public function test_user_seeder_creates_expected_records(): void
    {
        Artisan::call('db:seed', ['--class' => \Database\Seeders\UserSeeder::class]);
        $this->assertDatabaseHas('users', [
            'id' => 1,
            'name' => 'BOT',
            'email' => 'bot@example.com',
        ]);
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
