<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Material;

class MaterialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $wood = Material::firstOrCreate(
            ['name' => 'Holz', 'parent_id' => null]
        );

        $metal = Material::firstOrCreate(
            ['name' => 'Metall', 'parent_id' => null]
        );

        $oak = Material::firstOrCreate([
            'name' => 'Eiche',
            'parent_id' => $wood->id,
        ]);

        $steel = Material::firstOrCreate([
            'name' => 'Stahl',
            'parent_id' => $metal->id,
        ]);

        $aluminum = Material::firstOrCreate([
            'name' => 'Aluminium',
            'parent_id' => $metal->id,
        ]);

        $this->command->info('5 Materials wurden erfolgreich erstellt:');
        $this->command->info('- Holz (Root)');
        $this->command->info('  └── Eiche (Child)');
        $this->command->info('- Metall (Root)');
        $this->command->info('  ├── Stahl (Child)');
        $this->command->info('  └── Aluminium (Child)');
    }
}
