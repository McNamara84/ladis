<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Configuration;
use App\Models\Lens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function test_lens_relationship_is_belongsto(): void
    {
        $config = new Configuration();
        $relation = $config->lens();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(Lens::class, $relation->getRelated());
        $this->assertSame('lens_id', $relation->getForeignKeyName());
    }

    public function test_lens_relation_returns_associated_model(): void
    {
        $lens = Lens::create(['size' => 42]);
        $config = Configuration::create([
            'lens_id' => $lens->id,
            'focal_length' => 100,
            'output' => 10,
            'pw' => 100,
            'pf' => 10,
            'scan_width' => 2.0,
            'scan_frequency' => 5,
            'spot_size' => 0.5,
            'fluence' => 1.234,
        ]);

        $this->assertTrue($config->lens->is($lens));
    }

    public function test_processes_relationship_is_has_many(): void
    {
        $config = new Configuration();
        $relation = $config->processes();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertEquals('configuration_id', $relation->getForeignKeyName());
    }
}
