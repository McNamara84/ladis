<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artifact;

class ArtifactFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $artifact = Artifact::factory()->create();

        $this->assertInstanceOf(Artifact::class, $artifact);
        $this->assertDatabaseHas('artifacts', ['id' => $artifact->id]);
    }
}
