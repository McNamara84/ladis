<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\City;

class CityFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $city = City::factory()->create();

        $this->assertInstanceOf(City::class, $city);
        $this->assertDatabaseHas('cities', ['id' => $city->id]);
    }
}
