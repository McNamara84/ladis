<?php

namespace Database\Seeders;
use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the user seeds.
     */

    /**
     * This method creates a BOT user if it does not already exist in the database.
     * The BOT user should always be the first user, which is why the 'id' is set to 1.
     */

    public function run(): void
    {
        $user = User::find(1);
        if (!$user) {
            User::factory()->create([
                'id' => 1,
                'name' => 'BOT',
                'email' => 'bot@example.com',
            ]);

        }

    }

}

