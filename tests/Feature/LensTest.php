<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Lens;
use App\Models\Configuration;
use App\Models\Device;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LensTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_and_casts_are_defined(): void
    {
        $lens = new Lens(['size' => '12']);

        $this->assertSame(['size'], $lens->getFillable());
        $this->assertIsInt($lens->size);
    }

    public function test_relationships(): void
    {
        $lens = Lens::factory()->create();
        $config = Configuration::factory()->create(['lens_id' => $lens->id]);
        $device = Device::factory()->create();
        $lens->devices()->attach($device);

        $this->assertInstanceOf(HasMany::class, $lens->configurations());
        $this->assertInstanceOf(BelongsToMany::class, $lens->devices());
        $this->assertTrue($lens->configurations->contains($config));
        $this->assertTrue($lens->devices->contains($device));
    }
}
