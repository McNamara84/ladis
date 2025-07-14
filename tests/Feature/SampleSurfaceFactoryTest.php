<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\SampleSurface;

class SampleSurfaceFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $sample = SampleSurface::factory()->create();

        $this->assertInstanceOf(SampleSurface::class, $sample);
        $this->assertDatabaseHas('sample_surfaces', ['id' => $sample->id]);
    }
}
