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
     * Test whether a second BOT user gets created even though it already exists.
     */
    public function test_user_seeder_does_not_create_bot_user_because_it_already_exists(): void
    {
        Artisan::call('db:seed', ['--class' => \Database\Seeders\UserSeeder::class]);
        $recordCountBefore = DB::table('users')->count();
        Artisan::call('db:seed', ['--class' => \Database\Seeders\UserSeeder::class]);
        $recordCountAfter = DB::table('users')->count();
        $this->assertEquals($recordCountBefore, $recordCountAfter);

    }
}
