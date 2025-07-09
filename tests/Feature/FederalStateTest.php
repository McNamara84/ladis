<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\FederalState;
use App\Models\City;
use Illuminate\Database\Eloquent\Relations\HasMany;

class FederalStateTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_attributes_are_defined(): void
    {
        $state = new FederalState();

        $this->assertSame(['name'], $state->getFillable());
    }

    public function test_cities_relationship_is_hasmany(): void
    {
        $state = FederalState::factory()->create();
        $city = City::factory()->create(['federal_state_id' => $state->id]);

        $relation = $state->cities();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertTrue($state->cities->contains($city));
    }
}
