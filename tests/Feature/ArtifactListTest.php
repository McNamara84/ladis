<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Artifact;
use App\Models\User;

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

    public function test_guest_does_not_see_create_button(): void
    {
        Artifact::factory()->create();

        $response = $this->get('/artifacts/all');

        $response->assertStatus(200);
        $response->assertDontSee('Objekt hinzufügen');
    }

    public function test_authenticated_user_sees_create_button(): void
    {
        Artifact::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/artifacts/all');

        $response->assertStatus(200);
        $response->assertSee('Objekt hinzufügen');
    }

    public function test_artifact_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $artifact = Artifact::factory()->create();

        $response = $this->actingAs($user)->delete(route('artifacts.destroy', $artifact));

        $response->assertRedirect(route('artifacts.all'));
        $this->assertModelMissing($artifact);
    }

    public function test_guest_cannot_delete_artifact(): void
    {
        $artifact = Artifact::factory()->create();

        $response = $this->delete(route('artifacts.destroy', $artifact));

        $response->assertRedirect('/login');
        $this->assertModelExists($artifact);
    }
}
