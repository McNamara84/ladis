<?php

namespace Database\Seeders;
use App\Models\Institution;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the institution seeds.
     */
    public function run(): void
    {
        Institution::create([
        'name' => '',
        'type' => Institution::TYPE_MANUFACTURER,
        'contact_information' => '',
        ]);

        Institution::create([
        'name' => '',
        'type' => Institution::TYPE_MANUFACTURER,
        'contact_information' => '',
        ]);

        Institution::create([
        'name' => '',
        'type' => Institution::TYPE_MANUFACTURER,
        'contact_information' => '',
        ]);
    }
}
