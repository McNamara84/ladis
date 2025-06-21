<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use App\Models\Institution;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Test-User
        $user = User::firstOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email' => 'test@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // Create Test-Institution
        $institution = Institution::firstOrCreate(
            ['name' => 'Fachhochschule Potsdam'],
            [
                'name' => 'Fachhochschule Potsdam',
                'type' => Institution::TYPE_CONTRACTOR,
                'contact_information' => 'test@fh-potsdam.de',
            ]
        );

        echo "Test Institution created: {$institution->name} (ID: {$institution->id})\n";
        echo "Test User created: {$user->name} (ID: {$user->id})\n";
    }
}
