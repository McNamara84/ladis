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

    public function test_casts_for_attributes_are_applied(): void
    {
        $condition = new Condition([
            'wac' => '1.25',
            'lab_l' => 50.678,
            'lab_a' => '5.4321',
            'lab_b' => 3,
        ]);

        $this->assertIsFloat($condition->wac);
        $this->assertSame(1.25, $condition->wac);
        $this->assertSame('50.68', $condition->lab_l);
        $this->assertSame('5.43', $condition->lab_a);
        $this->assertSame('3.00', $condition->lab_b);
    }
}
