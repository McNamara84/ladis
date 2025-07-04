<?php

namespace Tests\Unit;
use Tests\TestCase;
use App\Models\Lens;

class LensFactoryTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function lens_gets_created_with_valid_values(): void
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
