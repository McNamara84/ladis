<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Configuration;
use App\Models\Lens;

class ConfigurationFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        Lens::factory()->create();
        $configuration = Configuration::factory()->create();

        $this->assertInstanceOf(Configuration::class, $configuration);
        $this->assertDatabaseHas('configurations', ['id' => $configuration->id]);
    }
}
