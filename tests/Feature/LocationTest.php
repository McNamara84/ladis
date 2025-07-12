<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Location;
use App\Models\Venue;
use App\Models\Artifact;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class LocationTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_and_casts_are_defined(): void
    {
        $location = new Location(['venue_id' => '1', 'name' => 'Main']);

        $this->assertSame(['venue_id', 'name'], $location->getFillable());
        $this->assertIsInt($location->venue_id);
        $this->assertIsString($location->name);
    }

    public function test_relationships(): void
    {
        $venue = Venue::factory()->create();
        $location = Location::factory()->for($venue)->create();
        $artifact = Artifact::factory()->for($location)->create();

        $this->assertInstanceOf(BelongsTo::class, $location->venue());
        $this->assertInstanceOf(HasMany::class, $location->artifacts());
        $this->assertTrue($location->artifacts->contains($artifact));
    }
}
