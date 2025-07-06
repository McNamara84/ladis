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
    public function test_example(): void
    public function test_device_seeder_does_not_create_records_with_non_csv_files(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
