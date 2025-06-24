<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Configuration;

class ConfigurationTest extends TestCase
{
    use RefreshDatabase;

    public function test_casts_for_attributes_are_applied(): void
    {
        $config = new Configuration([
            'lens_id' => '1',
            'focal_length' => '50',
            'output' => '12.5',
            'pw' => '100',
            'pf' => '10',
            'scan_width' => 5.2,
            'scan_frequency' => '60',
            'spot_size' => 0.5,
            'fluence' => 3.4567,
            'description' => 123,
        ]);

        $this->assertIsInt($config->lens_id);
        $this->assertIsInt($config->focal_length);
        $this->assertIsFloat($config->output);
        $this->assertIsInt($config->pw);
        $this->assertIsInt($config->pf);
        $this->assertSame('5.2', $config->scan_width);
        $this->assertIsInt($config->scan_frequency);
        $this->assertSame('0.5', $config->spot_size);
        $this->assertSame('3.457', $config->fluence);
        $this->assertIsString($config->description);
    }
}
