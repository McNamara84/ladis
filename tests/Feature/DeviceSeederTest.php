<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;


class DeviceSeederTest extends TestCase
{
    use RefreshDatabase;

    private function get_file_count() {
    $fileCount = count(Storage::disk('local')->files('devices'));

    return $fileCount;
    }
    /**
     * A basic feature test example.
     */
    public function test_example(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
