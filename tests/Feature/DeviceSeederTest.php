<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;


class DeviceSeederTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    private function getFileCount()
    {
        $fileCount = count(Storage::disk('local')->files('devices'));

        return $fileCount;
    }
    protected function setUp(): void
    {
        parent::setUp();

        Artisan::call('db:seed', ['--class' => \Database\Seeders\UserSeeder::class]);
        Artisan::call('db:seed', ['--class' => \Database\Seeders\InstitutionSeeder::class]);
        Artisan::call('db:seed', ['--class' => \Database\Seeders\DeviceSeeder::class]);

    }

    /**
     * A basic feature test example.
     */
    public function test_device_seeder_creates_expected_records(): void
    {
        $fileCount = $this->getFileCount();
        $this->assertDatabaseCount('devices', $fileCount);
    }
    /**
     * A basic feature test example.
     */
    public function test_device_seeder_does_not_create_records_with_non_csv_files(): void
    {

        $recordCountBefore = DB::table('devices')->count();
        try {
            Storage::disk('local')->put('devices/test.txt', 'test');
            Storage::disk('local')->put('devices/test2.json', '{"test2":"test2"}');

            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\DeviceSeeder::class,
            ]);

            $recordCountAfter = DB::table('devices')->count();

            $this->assertEquals($recordCountBefore, $recordCountAfter);
        } finally {
            Storage::disk('local')->delete(['devices/test.txt', 'devices/test2.json']);
        }
    }


        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\DeviceSeeder::class,
        ]);

        $recordCountAfter = DB::table('devices')->count();
    public function test_device_seeder_does_not_create_records_because_of_non_matching_delimiter(): void
    {
        $example_csv = <<<CSV
        name,description,year,build,height,width,depth,weight,fiber_length,cooling,mounting,automation,max_output,mean_output,max_wattage,head,emission_source,beam_type,beam_profile,wavelength,min_spot_size,max_spot_size,min_pf,max_pf,min_pw,max_pw,min_scan_width,max_scan_width,min_focal_length,max_focal_length,safety_class,last_edit_by,institution_id
        CL 20 BACKPACK,,,,220,400,650,14.5,,0,,,,20,,,,1,,1064,,,,,,,,,,,,1,2
        CSV;

        $recordCountBefore = DB::table('devices')->count();

        try {

            Storage::disk('local')->put('devices/test.csv', $example_csv);

            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\DeviceSeeder::class,
            ]);

            $recordCountAfter = DB::table('devices')->count();

            $this->assertEquals($recordCountBefore, $recordCountAfter);
        } finally {
            Storage::disk('local')->delete(['devices/test.csv']);
        }
    }

        $this->assertEquals($recordCountBefore, $recordCountAfter);
    public function test_device_seeder_does_not_create_records_because_of_missing_required_values(): void
    {
        $example_csv = <<<CSV
        name,description,year,build,height,width,depth,weight,fiber_length,cooling,mounting,automation,max_output,mean_output,max_wattage,head,emission_source,beam_type,beam_profile,wavelength,min_spot_size,max_spot_size,min_pf,max_pf,min_pw,max_pw,min_scan_width,max_scan_width,min_focal_length,max_focal_length,safety_class,last_edit_by,institution_id
        ,,,,220,400,650,14.5,,0,,,,20,,,,,,1064,,,,,,,,,,,,1,
        CSV;

        $recordCountBefore = DB::table('devices')->count();

        try {
            Storage::disk('local')->put('devices/test.csv', $example_csv);

            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\DeviceSeeder::class,
            ]);

            $recordCountAfter = DB::table('devices')->count();

            $this->assertEquals($recordCountBefore, $recordCountAfter);
        } finally {
            Storage::disk('local')->delete(['devices/test.csv']);

        }
    }

    public function test_device_seeder_does_not_create_records_because_name_is_not_unique(): void
    {
        $example_csv_1 = <<<CSV
        name,description,year,build,height,width,depth,weight,fiber_length,cooling,mounting,automation,max_output,mean_output,max_wattage,head,emission_source,beam_type,beam_profile,wavelength,min_spot_size,max_spot_size,min_pf,max_pf,min_pw,max_pw,min_scan_width,max_scan_width,min_focal_length,max_focal_length,safety_class,last_edit_by,institution_id
        CL 20 BACKPACK,,,,220,400,650,14.5,,0,,,,20,,,,1,,1064,,,,,,,,,,,,1,2
        CSV;

        $example_csv_2 = <<<CSV
        name,description,year,build,height,width,depth,weight,fiber_length,cooling,mounting,automation,max_output,mean_output,max_wattage,head,emission_source,beam_type,beam_profile,wavelength,min_spot_size,max_spot_size,min_pf,max_pf,min_pw,max_pw,min_scan_width,max_scan_width,min_focal_length,max_focal_length,safety_class,last_edit_by,institution_id
        CL 20 BACKPACK,,,,220,400,650,14.5,,0,,,,20,,,,1,,1064,,,,,,,,,,,,1,2
        CSV;

        $recordCountBefore = DB::table('devices')->count();

        try {
            Storage::disk('local')->put('devices/test1.csv', $example_csv_1);
            Storage::disk('local')->put('devices/test2.csv', $example_csv_2);

            Artisan::call('db:seed', [
                '--class' => \Database\Seeders\DeviceSeeder::class,
            ]);

            $recordCountAfter = DB::table('devices')->count();

            $this->assertEquals($recordCountBefore, $recordCountAfter);
        } finally {
            Storage::disk('local')->delete(['devices/test1.csv', 'devices/test2.csv']);
        }
    }
}
