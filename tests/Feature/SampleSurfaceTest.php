<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\SampleSurface;
use App\Models\Artifact;
use App\Models\PartialSurface;
use App\Models\Condition;
use App\Models\Material;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleSurfaceTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_attributes_are_defined(): void
    {
        $sample = new SampleSurface();

        $this->assertSame(['artifacts_id', 'name', 'description'], $sample->getFillable());
    }

    public function test_relationships(): void
    {
        $sample = SampleSurface::factory()->create();
        $partial = PartialSurface::create([
            'sample_surface_id' => $sample->id,
            'foundation_material_id' => Material::create(['name' => 'm'])->id,
            'coating_material_id' => Material::create(['name' => 'c'])->id,
            'condition_id' => Condition::factory()->create()->id,
            'result_id' => Condition::factory()->create()->id,
            'size' => 1.0,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $sample->artifact());
        $this->assertInstanceOf(HasMany::class, $sample->partialSurfaces());
        $this->assertTrue($sample->partialSurfaces->contains($partial));
    }
}
