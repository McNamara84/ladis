<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Condition;

class ConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_attributes_are_defined(): void
    {
        $condition = new Condition();

        $this->assertSame([
            'damage_pattern_id',
            'wac',
            'description',
            'lab_l',
            'lab_a',
            'lab_b',
            'severity',
            'adhesion',
        ], $condition->getFillable());
    }
}
