<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Venue;
use App\Models\City;

class VenueFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_multiple_venues_for_same_city_receive_unique_names(): void
    {
        $city = City::factory()->create();

        $venues = Venue::factory()->for($city)->count(5)->create();

        $this->assertCount(5, $venues);
        $this->assertSame(5, $venues->pluck('name')->unique()->count());
        $this->assertTrue($venues->every(fn ($venue) => str_contains($venue->name, '#')));
    }
}