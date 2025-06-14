<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\City;
use App\Models\FederalState;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CityTest extends TestCase
{
    public function test_fillable_attributes_are_defined(): void
    {
        $city = new City();
        $this->assertSame([
            'federal_state_id',
            'name',
            'postal_code',
        ], $city->getFillable());
    }

    public function test_federal_state_relationship_is_belongsto(): void
    {
        $city = new City();
        $relation = $city->federalState();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(FederalState::class, $relation->getRelated());
        $this->assertSame('federal_state_id', $relation->getForeignKeyName());
    }
}
