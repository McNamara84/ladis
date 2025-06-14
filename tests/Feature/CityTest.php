<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\City;

class CityTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_fillable_attributes_are_defined(): void
    {
        $city = new City();
        $this->assertSame([
            'federal_state_id',
            'name',
            'postal_code',
        ], $city->getFillable());
    }
}
