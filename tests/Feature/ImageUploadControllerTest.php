<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use Exception;
use App\Models\Condition;

class ImageUploadControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Image::flushEventListeners();
        Image::clearBootedModels();
        parent::tearDown();
    }

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

        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk('public');
        $storage->assertExists("uploads/{$project->id}/{$file->hashName()}");

        $this->assertDatabaseHas('images', [
            'project_id' => $project->id,
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);
    }

    public function test_store_saves_condition_when_provided(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $condition = Condition::factory()->create();
        $file = UploadedFile::fake()->image('condition.jpg');

        $response = $this->actingAs($user)->post('/inputform_image', [
            'image' => $file,
            'project_id' => $project->id,
            'condition_id' => $condition->id,
            'description' => 'Test',
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);

        $response->assertRedirect(route('inputform_image.index'));

        $this->assertDatabaseHas('images', [
            'project_id' => $project->id,
            'condition_id' => $condition->id,
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);
    }

    public function test_store_sets_condition_to_null_when_omitted(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('nocondition.jpg');

        $response = $this->actingAs($user)->post('/inputform_image', [
            'image' => $file,
            'project_id' => $project->id,
            'description' => 'Test',
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);

        $response->assertRedirect(route('inputform_image.index'));

        $this->assertDatabaseHas('images', [
            'project_id' => $project->id,
            'condition_id' => null,
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

    public function test_guest_is_redirected_from_form(): void
    {
        $response = $this->get('/inputform_image');

        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_image(): void
    {
        Storage::fake('public');
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('guest.jpg');

        $response = $this->post('/inputform_image', [
            'image' => $file,
            'project_id' => $project->id,
            'alt_text' => 'Alt',
            'year_created' => 2024,
            'creator' => 'Tester',
        ]);

        $response->assertRedirect('/login');
        /** @var \Illuminate\Filesystem\FilesystemAdapter $storage */
        $storage = Storage::disk('public');
        $storage->assertMissing("uploads/{$project->id}/{$file->hashName()}");
        $this->assertDatabaseCount('images', 0);
    }

    public function test_store_fails_validation_when_alt_text_missing(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('photo.jpg');

        $response = $this->actingAs($user)
            ->from('/inputform_image')
            ->post('/inputform_image', [
                'image' => $file,
                'project_id' => $project->id,
                'year_created' => 2024,
                'creator' => 'Tester',
            ]);

        $response->assertRedirect('/inputform_image');
        $response->assertSessionHasErrors('alt_text');
        $this->assertDatabaseCount('images', 0);
    }

    public function test_store_handles_exception_and_redirects_back(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $project = Project::factory()->create();
        $file = UploadedFile::fake()->image('fail.jpg');

        Image::creating(function () {
            throw new Exception('fail');
        });

        $response = $this->actingAs($user)
            ->withHeader('referer', '/inputform_image')
            ->post('/inputform_image', [
                'image' => $file,
                'project_id' => $project->id,
                'description' => 'Test',
                'alt_text' => 'Alt',
                'year_created' => 2024,
                'creator' => 'Tester',
            ]);

        $response->assertRedirect('/inputform_image');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('images', 0);
    }
}
