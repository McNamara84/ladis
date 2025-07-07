<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\DB;
use App\Models\Institution;

class InstitutionSeederTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test whether institution records have been created after calling the seeder.
     */
    public function test_institution_seeder_creates_expected_records(): void
    {
        Artisan::call('db:seed', ['--class' => \Database\Seeders\InstitutionSeeder::class]);
        $this->assertDatabaseHas(
            'institutions',
            [
                'id' => 1,
                'name' => 'EL.EN. S.p.A.',
                'type' => Institution::TYPE_MANUFACTURER,
                'contact_information' => 'https://elengroup.com/en/'
            ]
        );
        $this->assertDatabaseHas(
            'institutions',
            [
                'id' => 2,
                'name' => 'Clean-Lasersysteme GmbH',
                'type' => Institution::TYPE_MANUFACTURER,
                'contact_information' => 'https://www.cleanlaser.de/de/kontakt/',
            ]
        );
    }
    /**
     * Ensures that the seeder does not create duplicate institution records.
     */
    public function test_institution_seeder_does_not_create_duplicates_because_they_already_exist(): void
    {
        Artisan::call('db:seed', ['--class' => \Database\Seeders\InstitutionSeeder::class]);
        $record_count_before = DB::table('institutions')->count();
        Artisan::call('db:seed', ['--class' => \Database\Seeders\InstitutionSeeder::class]);
        $record_count_after = DB::table('institutions')->count();
        $this->assertEquals($record_count_before, $record_count_after);

    }
}
