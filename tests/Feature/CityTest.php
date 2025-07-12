<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\City;
use App\Models\FederalState;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Venue;

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

    public function test_postal_code_is_cast_to_string(): void
    {
        $city = new City([
            'federal_state_id' => 1,
            'name' => 'Potsdam',
            'postal_code' => 14469,
        ]);

        $this->assertSame('14469', $city->postal_code);
    }

    public function test_full_name_returns_only_city_name_when_relationship_not_loaded(): void
    {
        $city = new City(['name' => 'Potsdam']);

        $this->assertSame('Potsdam', $city->full_name);
    }

    public function test_full_name_includes_federal_state_when_relationship_loaded(): void
    {
        $city = new City(['name' => 'Potsdam']);
        $state = new FederalState(['name' => 'Brandenburg']);
        $city->setRelation('federalState', $state);

        $this->assertSame('Potsdam, Brandenburg', $city->full_name);
    }

    public function test_venues_relationship_returns_related_models(): void
    {
        $city = new City();
        $relation = $city->venues();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertInstanceOf(Venue::class, $relation->getRelated());
    }
}
