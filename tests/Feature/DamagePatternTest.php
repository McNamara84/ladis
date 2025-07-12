<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\DamagePattern;
use App\Models\Condition;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DamagePatternTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_attributes_are_defined(): void
    {
        $pattern = new DamagePattern();

        $this->assertSame(['name'], $pattern->getFillable());
    }

    public function test_conditions_relationship_is_hasmany(): void
    {
        $pattern = DamagePattern::factory()->create();
        $condition = Condition::create([
            'damage_pattern_id' => $pattern->id,
            'severity' => 'leicht',
            'adhesion' => 'gut',
        ]);

        $relation = $pattern->conditions();

        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertTrue($pattern->conditions->contains($condition));
    }
}
