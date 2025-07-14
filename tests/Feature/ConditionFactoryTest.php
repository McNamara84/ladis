<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Condition;

class ConditionFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $condition = Condition::factory()->create();

        $this->assertInstanceOf(Condition::class, $condition);
        $this->assertDatabaseHas('conditions', ['id' => $condition->id]);
    }
}
