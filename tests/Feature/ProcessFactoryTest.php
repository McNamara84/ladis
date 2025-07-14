<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Process;
use App\Models\SampleSurface;
use App\Models\Material;
use App\Models\Condition;
use App\Models\PartialSurface;
use App\Models\Device;
use App\Models\Lens;
use App\Models\Configuration;

class ProcessFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        SampleSurface::factory()->create();
        Material::factory()->parent()->count(3)->create();
        Condition::factory()->count(5)->create();
        PartialSurface::factory()->create();
        Device::factory()->create();
        Device::factory()->create();
        Lens::factory()->create();
        Configuration::factory()->create();
        Configuration::factory()->create();
        Configuration::factory()->create();

        $process = Process::factory()->create();

        $this->assertInstanceOf(Process::class, $process);
        $this->assertDatabaseHas('processes', ['id' => $process->id]);
    }
}
