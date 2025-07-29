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

    public function test_projects_list_page_displays_no_projects_message_when_empty(): void
    {
        $response = $this->get('/projects/all');

        $response->assertStatus(200);
        $response->assertSee('Keine Projekte vorhanden.');
    }

    public function test_project_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($user)->delete(route('projects.destroy', $project));

        $response->assertRedirect(route('projects.all'));
        $response->assertSessionHas('success');
        $this->assertStringContainsString('Projekt wurde', $response->baseResponse->getSession()->get('success'));
        $this->assertModelMissing($project);
    }

    public function test_guest_cannot_delete_project(): void
    {
        $project = Project::factory()->create();

        $response = $this->delete(route('projects.destroy', $project));

        $response->assertRedirect('/login');
        $this->assertModelExists($project);
    }

    public function test_authenticated_user_sees_create_and_delete_buttons(): void
    {
        $user = User::factory()->create();
        Project::factory()->create();

        $response = $this->actingAs($user)->get('/projects/all');

        $response->assertStatus(200);
        $response->assertSee('Neues Projekt anlegen');
        $response->assertSee('Löschen');
    }

    public function test_guest_does_not_see_create_or_delete_buttons(): void
    {
        Project::factory()->create();

        $response = $this->get('/projects/all');

        $response->assertStatus(200);
        $response->assertDontSee('Neues Projekt anlegen');
        $response->assertDontSee('Löschen');
    }
}
