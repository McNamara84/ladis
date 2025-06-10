<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Institution;

class InstitutionTest extends TestCase
{
    /**
     * Tests whether the getTypes() method from the Institution model
     * correctly returns the expected values used as enums for material types.
     */
    public function test_get_types_returns_all_expected_values(): void
    {
        $expected = [
            Institution::TYPE_CLIENT,
            Institution::TYPE_CONTRACTOR,
            Institution::TYPE_MANUFACTURER,
        ];

        $this->assertEquals($expected, Institution::getTypes());
    }
}
