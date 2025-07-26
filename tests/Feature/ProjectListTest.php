<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ProjectListTest extends TestCase
{
    use RefreshDatabase;

    public function test_projects_list_page_displays_projects(): void
    {
        Project::factory()->count(2)->create();

        $response = $this->get('/projects/all');

        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
        $response->assertViewHas('projects');
    }

    public function test_project_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($user)->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.all'));
        $this->assertModelMissing($project);
    }

    public function test_guest_cannot_delete_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect('/login');
        $this->assertModelExists($project);
    }
}
