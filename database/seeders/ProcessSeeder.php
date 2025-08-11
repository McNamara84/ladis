<?php

namespace Database\Seeders;

use App\Models\Process;
use App\Models\Device;
use App\Models\Material;
use App\Models\DamagePattern;
use App\Models\Configuration;
use App\Models\Lens;
use App\Models\PartialSurface;
use App\Models\SampleSurface;
use App\Models\Artifact;
use App\Models\Location;
use App\Models\Venue;
use App\Models\City;
use App\Models\FederalState;
use App\Models\Condition;
use App\Models\Person;
use App\Models\Institution;
use App\Models\Project;
use Illuminate\Database\Seeder;

class ProcessSeeder extends Seeder
{
    /**
     * Run the process seeds.
     *
     * Creates Process records using existing seeded data where possible.
     */
    public function run(): void
    {
        // Set the number of processes to create
        $count = 5;

        // Ensure we have required seeded data
        $this->ensureRequiredDataExists();

        // Get existing records to avoid unique constraint violations
        $devices = Device::all();
        $materials = Material::all();
        $damagePatterns = DamagePattern::all();
        $institutions = Institution::all();

        if ($devices->isEmpty()) {
            $this->command->error('No devices found. Please run DeviceSeeder first.');
            return;
        }

        // Create shared entities that all processes will use

        // 1. Create shared location hierarchy (same for all processes)
        $federalState = FederalState::factory()->create();
        $city = City::factory()->for($federalState)->create();
        $venue = Venue::factory()->for($city)->create();
        $location = Location::factory()->for($venue)->create();
        $artifact = Artifact::factory()->for($location)->create();
        $sampleSurface = SampleSurface::factory()->for($artifact)->create();

        // 2. Create shared person and project (same for all processes)
        $person = Person::factory()->for($institutions->random())->create();
        Project::factory()->create([
            'person_id' => $person->id,
            'venue_id' => $venue->id,
        ]);

        // Now create processes - each gets unique PartialSurface, Configuration, but shares everything else
        for ($i = 0; $i < $count; $i++) {
            // 3. Create unique conditions for each process using existing damage patterns
            $damagePattern = $damagePatterns->random();
            $condition = Condition::factory()->for($damagePattern)->create();
            $result = Condition::factory()->for($damagePattern)->create();

            // 4. Create unique partial surface for each process using existing materials and shared sample surface
            $partialSurface = PartialSurface::factory()->create([
                'sample_surface_id' => $sampleSurface->id,
                'foundation_material_id' => $materials->random()->id,
                'coating_material_id' => $materials->random()->id,
                'condition_id' => $condition->id,
                'result_id' => $result->id,
            ]);

            // 5. Create unique lens and configuration for each process
            $lens = Lens::factory()->create();
            $configuration = Configuration::factory()->for($lens)->create();

            // 6. Create process using existing device and new configuration
            Process::create([
                'partial_surface_id' => $partialSurface->id,
                'device_id' => $devices->random()->id,
                'configuration_id' => $configuration->id,
                'duration' => fake()->randomElement([0, 1, 2, 3]),
                'wet' => fake()->randomElement([0, 1]),
                'description' => fake()->sentence(),
            ]);
        }

        $this->command->info('2 Processes were successfully created with complete dependency chain up to Project.');
    }

    /**
     * Ensure required seeded data exists
     */
    private function ensureRequiredDataExists(): void
    {
        if (Device::count() === 0) {
            $this->command->warn('No devices found. Running DeviceSeeder...');
            $this->call(DeviceSeeder::class);
        }

        if (Material::count() === 0) {
            $this->command->warn('No materials found. Running MaterialSeeder...');
            $this->call(MaterialSeeder::class);
        }

        if (DamagePattern::count() === 0) {
            $this->command->warn('No damage patterns found. Running DamagePatternSeeder...');
            $this->call(DamagePatternSeeder::class);
        }

        if (Institution::count() === 0) {
            $this->command->warn('No institutions found. Running InstitutionSeeder...');
            $this->call(InstitutionSeeder::class);
        }
    }
}
