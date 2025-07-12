<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PartialSurface;
use App\Models\SampleSurface;
use App\Models\Condition;
use App\Models\Material;
use App\Models\Configuration;
use App\Models\Process;
use App\Models\Device;
use App\Models\Artifact;
use App\Models\DamagePattern;
use App\Models\Lens;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PartialSurfaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_casts_are_defined(): void
    {
        $partial = new PartialSurface([
            'sample_surface_id' => '1',
            'foundation_material_id' => '2',
            'coating_material_id' => '3',
            'identifier' => 'A',
            'size' => '12.34',
        ]);

        $this->assertIsInt($partial->sample_surface_id);
        $this->assertIsInt($partial->foundation_material_id);
        $this->assertIsInt($partial->coating_material_id);
        $this->assertIsString($partial->identifier);
        $this->assertIsString($partial->size);
    }

    public function test_relationships(): void
    {
        $sample = SampleSurface::factory()->create();
        $condition = Condition::factory()->state(['severity' => 'leicht', 'adhesion' => 'gut'])->create();
        $result = Condition::factory()->state(['severity' => 'gut', 'adhesion' => 'schlecht'])->create();
        $material = Material::create(['name' => 'M']);
        $partial = PartialSurface::create([
            'sample_surface_id' => $sample->id,
            'foundation_material_id' => $material->id,
            'coating_material_id' => $material->id,
            'condition_id' => $condition->id,
            'result_id' => $result->id,
            'size' => 1.0,
        ]);
        $config = Configuration::create([
            'lens_id' => Lens::factory()->create()->id,
            'focal_length' => 100,
            'output' => 100,
            'pw' => 10,
            'pf' => 10,
            'scan_width' => 1.0,
            'scan_frequency' => 1,
            'spot_size' => 1.0,
            'fluence' => 1.0,
        ]);
        $process = Process::create([
            'partial_surface_id' => $partial->id,
            'device_id' => Device::factory()->create()->id,
            'configuration_id' => $config->id,
            'description' => 'test',
            'duration' => 0,
            'wet' => 0,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $partial->sampleSurface());
        $this->assertInstanceOf(HasOne::class, $partial->process());
        $this->assertInstanceOf(BelongsTo::class, $partial->condition());
        $this->assertInstanceOf(BelongsTo::class, $partial->result());
        $this->assertInstanceOf(BelongsTo::class, $partial->foundationMaterial());
        $this->assertInstanceOf(BelongsTo::class, $partial->coatingMaterial());
        $this->assertTrue($partial->process->is($process));
    }
}
