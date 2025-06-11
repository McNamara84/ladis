<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Artifact;
use App\Models\Location;
use App\Models\Venue;
use Illuminate\Database\QueryException;

class ArtifactTest extends TestCase
{
    use RefreshDatabase;

    private function createLocation(): Location
    {
        $venue = Venue::create(['name' => 'Test Venue']);

        return Location::create([
            'venue_id' => $venue->id,
            'name' => 'Test Location',
        ]);
    }

    public function test_artifact_can_be_created(): void
    {
        $location = $this->createLocation();

        $artifact = Artifact::factory()
            ->for($location)
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
        $location = $this->createLocation();
        $artifact = Artifact::factory()->for($location)->create();

        $this->assertTrue($artifact->location->is($location));
    }

    public function test_duplicate_name_in_same_location_is_not_allowed(): void
    {
        $location = $this->createLocation();
        Artifact::factory()->for($location)->create(['name' => 'Campus']);

        $this->expectException(QueryException::class);
        Artifact::factory()->for($location)->create(['name' => 'Campus']);
    }

    public function test_duplicate_inventory_number_in_same_location_is_not_allowed(): void
    {
        $location = $this->createLocation();
        Artifact::factory()->for($location)->create(['inventory_number' => 'INV-002']);

        $this->expectException(QueryException::class);
        Artifact::factory()->for($location)->create(['inventory_number' => 'INV-002']);
    }
}
