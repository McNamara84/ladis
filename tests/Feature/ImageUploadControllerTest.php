<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/inputform_image');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_image');
        $response->assertViewHas('projects');
        $response->assertViewHas('conditions');
    }

    public function test_store_saves_image_and_redirects(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($user)->post('/inputform_image', [
            'image' => $file,
            'project_id' => $project->id,
            'description' => 'Test',
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);

        $response->assertRedirect(route('inputform_image.index'));
        $response->assertSessionHas('success');

        Storage::disk('public')->assertExists("uploads/{$project->id}/{$file->hashName()}");

        $this->assertDatabaseHas('images', [
            'project_id' => $project->id,
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);
    }

    public function test_store_with_invalid_data_returns_errors(): void
    {
        $user = User::factory()->create();
        $project = Project::factory()->create();

        $response = $this->actingAs($user)
            ->from('/inputform_image')
            ->post('/inputform_image', [
                'project_id' => $project->id,
                'alt_text' => 'Alt',
                'year_created' => 2024,
                'creator' => 'Tester',
            ]);

        $response->assertRedirect('/inputform_image');
        $response->assertSessionHasErrors('image');
        $this->assertDatabaseCount('images', 0);
    }
}
