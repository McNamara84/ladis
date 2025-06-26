<?php

namespace Database\Seeders;
use App\Models\Institution;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstitutionSeeder extends Seeder
{
    /**
     * Run the institution seeds.
     */
    public function run(): void
    {
        $institution_1 = Institution::find(1);
        if (!$institution_1) {
            Institution::create([
                'name' => 'EL.EN. S.p.A.',
                'type' => Institution::TYPE_MANUFACTURER,
                'contact_information' => 'https://elengroup.com/en/',
            ]);
        }
        $institution_2 = Institution::find(2);
        if (!$institution_2) {
            Institution::create([
                'name' => 'Clean-Lasersysteme GmbH',
                'type' => Institution::TYPE_MANUFACTURER,
                'contact_information' => 'https://www.cleanlaser.de/de/kontakt/',
            ]);
        }
    }
}
