<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\DamagePattern;

class DamagePatternFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $pattern = DamagePattern::factory()->create();

        $this->assertInstanceOf(DamagePattern::class, $pattern);
        $this->assertDatabaseHas('damage_patterns', ['id' => $pattern->id]);
    }
}
