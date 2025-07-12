<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Process;
use App\Models\Device;
use App\Models\Lens;
use App\Models\Configuration;
use App\Models\Artifact;
use App\Models\SampleSurface;
use App\Models\PartialSurface;
use App\Models\Material;
use App\Models\Condition;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProcessTest extends TestCase
{
    use RefreshDatabase;

    public function test_casts_and_constants(): void
    {
        $process = new Process([
            'duration' => '1',
            'wet' => '0',
        ]);

        $this->assertIsInt($process->duration);
        $this->assertIsInt($process->wet);
        $this->assertContains($process->duration, Process::getDurations());
        $this->assertContains($process->wet, Process::getWetTypes());
    }

    public function test_relationships(): void
    {
        $device = Device::factory()->create();
        $lens = Lens::factory()->create();
        $config = Configuration::create([
            'lens_id' => $lens->id,
            'focal_length' => 100,
            'output' => 100,
            'pw' => 10,
            'pf' => 10,
            'scan_width' => 1.0,
            'scan_frequency' => 1,
            'spot_size' => 1.0,
            'fluence' => 1.0,
        ]);
        $artifact = Artifact::factory()->create();
        $sample = SampleSurface::forceCreate([
            'name' => 's',
            'description' => 'd',
            'artifacts_id' => $artifact->id,
        ]);
        $partial = PartialSurface::create([
            'sample_surface_id' => $sample->id,
            'foundation_material_id' => Material::create(['name' => 'm'])->id,
            'coating_material_id' => Material::create(['name' => 'c'])->id,
            'condition_id' => Condition::create(['severity' => 'ok', 'adhesion' => 'gut', 'damage_pattern_id' => DamagePattern::factory()->create()->id])->id,
            'result_id' => Condition::create(['severity' => 'ok', 'adhesion' => 'gut', 'damage_pattern_id' => DamagePattern::factory()->create()->id])->id,
            'size' => 1.0,
        ]);
        $process = Process::create([
            'partial_surface_id' => $partial->id,
            'device_id' => $device->id,
            'configuration_id' => $config->id,
            'description' => 'proc',
            'duration' => 0,
            'wet' => 0,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $process->device());
        $this->assertInstanceOf(BelongsTo::class, $process->configuration());
        $this->assertInstanceOf(BelongsTo::class, $process->partialSurface());
        $this->assertTrue($process->device->is($device));
        $this->assertTrue($process->configuration->is($config));
        $this->assertTrue($process->partialSurface->is($partial));
    }
}
