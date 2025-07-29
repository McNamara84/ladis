<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Location;

class LocationFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $location = Location::factory()->create();

        $this->assertInstanceOf(Location::class, $location);
        $this->assertDatabaseHas('locations', ['id' => $location->id]);
    }
}
