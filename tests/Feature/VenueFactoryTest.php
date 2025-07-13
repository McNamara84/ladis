<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Venue;

class VenueFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $venue = Venue::factory()->create();

        $this->assertInstanceOf(Venue::class, $venue);
        $this->assertDatabaseHas('venues', ['id' => $venue->id]);
    }
}
