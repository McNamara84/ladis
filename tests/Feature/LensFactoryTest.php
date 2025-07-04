<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lens;


class LensFactoryTest extends TestCase
{
    
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */

    public function test_lenses_get_created_with_valid_values(): void
    {
        $lenses = Lens::factory()->count(10)->create();
        $this->assertEquals($lenses->count(), $lenses->unique('size')->count());

        foreach ($lenses as $lens) {
            $this->assertNotNull($lens);
            $this->assertGreaterThan(0, $lens->size);
            $this->assertLessThanOrEqual(255, $lens->size);
            $this->assertDatabaseHas('lenses', ['id' => $lens->id]);
        }
    }
    
}
