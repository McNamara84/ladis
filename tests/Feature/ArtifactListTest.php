<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artifact;

class ArtifactListTest extends TestCase
{
    use RefreshDatabase;

    public function test_artifacts_list_page_displays_artifacts(): void
    {
        Artifact::factory()->count(2)->create();

        $response = $this->get('/artifacts/all');

        $response->assertStatus(200);
        $response->assertViewIs('artifacts.index');
        $response->assertViewHas('artifacts');
    }
}
