<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Venue;
use App\Models\City;
use App\Models\Location;
use App\Models\Project;
use App\Models\Person;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VenueTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_and_casts_are_defined(): void
    {
        $venue = new Venue(['city_id' => '1', 'name' => 'Town Hall']);

        $this->assertSame(['city_id', 'name'], $venue->getFillable());
        $this->assertIsInt($venue->city_id);
        $this->assertIsString($venue->name);
    }

    public function test_relationships(): void
    {
        $city = City::factory()->create();
        $venue = Venue::factory()->for($city)->create();
        $location = Location::factory()->for($venue)->create();
        $project = Project::forceCreate([
            'name' => 'P',
            'description' => 'desc',
            'url' => 'http://example.com',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => Person::factory()->create()->id,
            'venue_id' => $venue->id,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $venue->city());
        $this->assertInstanceOf(HasMany::class, $venue->locations());
        $this->assertInstanceOf(HasMany::class, $venue->projects());
        $this->assertTrue($venue->locations->contains($location));
        $this->assertTrue($venue->projects->contains($project));
    }
}
