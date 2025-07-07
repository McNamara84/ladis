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
        Artisan::call('db:seed');

        $this->assertDatabaseCount('devices', $fileCount);
    }
    /**
     * A basic feature test example.
     */
    public function test_device_seeder_does_not_create_records_with_non_csv_files(): void
    {

        Artisan::call('db:seed');
        
        $recordCountBefore = DB::table('devices')->count();

        Storage::disk('local')->put('devices/test.txt', 'test');
        Storage::disk('local')->put('devices/test2.json', '{"test2":"test2"}');

        Artisan::call('db:seed', [
            '--class' => \Database\Seeders\DeviceSeeder::class,
        ]);

        $recordCountAfter = DB::table('devices')->count();

        $this->assertEquals($recordCountBefore, $recordCountAfter);

        Storage::disk('local')->delete(['devices/test.txt', 'devices/test2.json']);
    }
}
