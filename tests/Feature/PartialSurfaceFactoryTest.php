<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\PartialSurface;
use App\Models\SampleSurface;
use App\Models\Material;
use App\Models\Condition;

class PartialSurfaceFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        SampleSurface::factory()->create();
        Material::factory()->parent()->count(3)->create();
        Condition::factory()->count(5)->create();

        $partial = PartialSurface::factory()->create();

        $this->assertInstanceOf(PartialSurface::class, $partial);
        $this->assertDatabaseHas('partial_surfaces', ['id' => $partial->id]);
    }
}
