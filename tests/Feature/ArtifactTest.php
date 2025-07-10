<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artifact;
use App\Models\Location;
use Illuminate\Database\QueryException;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SampleSurface;

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

    public function test_fillable_and_casts_are_defined(): void
    {
        $artifact = new Artifact([
            'location_id' => '1',
            'name' => 'Test',
            'inventory_number' => 42,
        ]);

        $this->assertSame([
            'location_id',
            'name',
            'inventory_number',
        ], $artifact->getFillable());

        $this->assertIsInt($artifact->location_id);
        $this->assertIsString($artifact->inventory_number);
    }

    public function test_sample_surfaces_relationship_is_hasmany(): void
    {
        $artifact = new Artifact();
        $relation = $artifact->sampleSurfaces();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertSame(SampleSurface::class, $relation->getRelated()::class);
    }
}
