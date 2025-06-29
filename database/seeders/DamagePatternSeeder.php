<?php

namespace Database\Seeders;

use App\Models\DamagePattern;
use Database\Factories\DamagePatternFactory;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DamagePatternSeeder extends Seeder
{
    /**
     * Run the damage pattern seeds.
     */
    public function run(): void
    {
        DamagePattern::factory()->count(count(DamagePatternFactory::$patterns))->create();
    }
}
