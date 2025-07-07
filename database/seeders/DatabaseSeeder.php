<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database. 
     * This seeder should only be used to define the order when calling each individual seeder class.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            InstitutionSeeder::class,
            DeviceSeeder::class,
            MaterialSeeder::class
        ]);
    }
}
