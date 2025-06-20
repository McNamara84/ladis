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
        'name' => 'EL.EN. S.p.A.',
        'type' => Institution::TYPE_MANUFACTURER,
        'contact_information' => 'https://elengroup.com/en/',
        ]);

        Institution::create([
        'name' => 'Clean-Lasersysteme GmbH',
        'type' => Institution::TYPE_MANUFACTURER,
        'contact_information' => 'https://www.cleanlaser.de/de/kontakt/',
        ]);
    }
}
