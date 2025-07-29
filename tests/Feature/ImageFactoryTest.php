<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Image;

class ImageFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $image = Image::factory()->create();

        $this->assertInstanceOf(Image::class, $image);
        $this->assertDatabaseHas('images', ['id' => $image->id]);
    }
}
