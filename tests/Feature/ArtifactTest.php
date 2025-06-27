<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artifact;
use App\Models\Location;
use Illuminate\Database\QueryException;

class ArtifactTest extends TestCase
{
    use RefreshDatabase;

    public function test_artifact_can_be_created(): void
    {
        $artifact = Artifact::factory()
            ->create([
                'name' => 'Büste von Professor Rolf Däßler',
                'inventory_number' => 'INV-001',
            ]);

        $this->assertDatabaseHas('artifacts', [
            'id' => $artifact->id,
            'name' => 'Büste von Professor Rolf Däßler',
            'inventory_number' => 'INV-001',
        ]);
    }

    public function test_location_relationship(): void
    {
        $location = Location::factory()->create();
        $artifact = Artifact::factory()->for($location)->create();

        $this->assertTrue($artifact->location->is($location));
    }

    public function test_duplicate_name_in_same_location_is_not_allowed(): void
    {
        $location = Location::factory()->create();
        Artifact::factory()->for($location)->create(['name' => 'Campus']);

        $this->expectException(QueryException::class);
        Artifact::factory()->for($location)->create(['name' => 'Campus']);
    }

    public function test_duplicate_inventory_number_in_same_location_is_not_allowed(): void
    {
        $location = Location::factory()->create();
        Artifact::factory()->for($location)->create(['inventory_number' => 'INV-002']);

        $this->expectException(QueryException::class);
        Artifact::factory()->for($location)->create(['inventory_number' => 'INV-002']);
    }

    public function test_duplicate_name_in_different_locations_is_allowed(): void
    {
        $locationA = Location::factory()->create();
        $locationB = Location::factory()->create();

        Artifact::factory()->for($locationA)->create(['name' => 'Campus GFZ']);
        $artifactB = Artifact::factory()->for($locationB)->create(['name' => 'Campus GFZ']);
        $this->assertDatabaseHas('artifacts', ['id' => $artifactB->id, 'name' => 'Campus GFZ']);
    }
}
