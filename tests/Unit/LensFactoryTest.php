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

        foreach($lenses as $lens){
        $this->assertNotNull($lens);
        $this->assertGreaterThan(0,$lens->size);
        $this->assertGreaterThanOrEqual(1, $lens->size);
        $this->assertLessThanOrEqual(255, $lens->size);
        }
    }
}
