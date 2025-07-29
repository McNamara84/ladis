<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\FederalState;

class FederalStateFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $state = FederalState::factory()->create();

        $this->assertInstanceOf(FederalState::class, $state);
        $this->assertDatabaseHas('federal_states', ['id' => $state->id]);
    }
}
