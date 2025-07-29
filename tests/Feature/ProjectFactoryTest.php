<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;

class ProjectFactoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_factory_creates_record(): void
    {
        $project = Project::factory()->create();

        $this->assertInstanceOf(Project::class, $project);
        $this->assertDatabaseHas('projects', ['id' => $project->id]);
    }

    public function test_factory_sets_person_and_venue(): void
    {
        $project = Project::factory()->create();

        $this->assertNotNull($project->person);
        $this->assertNotNull($project->venue);
        $this->assertDatabaseHas('persons', ['id' => $project->person_id]);
        $this->assertDatabaseHas('venues', ['id' => $project->venue_id]);
    }
}
