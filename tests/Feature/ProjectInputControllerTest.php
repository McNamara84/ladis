<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Person;
use App\Models\Venue;
use App\Models\Project;
use Illuminate\Support\Facades\Event;

class ProjectInputControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Person $person;
    private Venue $venue;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->person = Person::factory()->create();
        $this->venue = Venue::factory()->create();
    }

    public function test_guest_cannot_store_project(): void
    {
        $response = $this->post('/inputform_project', []);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('projects', 0);
    }

    public function test_store_creates_project_and_redirects(): void
    {
        $data = [
            'name' => 'Project X',
            'description' => 'Desc',
            'url' => 'https://example.com',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => $this->person->id,
            'venue_id' => $this->venue->id,
        ];

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_project')
            ->post('/inputform_project', $data);

        $response->assertRedirect('/inputform_project');
        $this->assertDatabaseHas('projects', [
            'name' => 'Project X',
            'url' => 'https://example.com',
        ]);
        $response->assertSessionHas('success');
    }

    public function test_store_fails_with_missing_fields(): void
    {
        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_project')
            ->post('/inputform_project', []);

        $response->assertRedirect('/inputform_project');
        $response->assertSessionHasErrors([
            'name',
            'description',
            'url',
            'started_at',
            'ended_at',
            'person_id',
            'venue_id',
        ]);
    }

    public function test_store_fails_when_end_date_before_start(): void
    {
        $data = [
            'name' => 'Wrong Dates',
            'description' => 'Desc',
            'url' => 'https://wrong.test',
            'started_at' => '2024-02-01',
            'ended_at' => '2024-01-01',
            'person_id' => $this->person->id,
            'venue_id' => $this->venue->id,
        ];

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_project')
            ->post('/inputform_project', $data);

        $response->assertRedirect('/inputform_project');
        $response->assertSessionHasErrors('ended_at');
        $this->assertDatabaseMissing('projects', ['name' => 'Wrong Dates']);
    }

    public function test_store_fails_with_non_unique_name_or_url(): void
    {
        Project::factory()->create([
            'name' => 'Unique',
            'url' => 'https://unique.test',
        ]);

        $data = [
            'name' => 'Unique',
            'description' => 'Desc',
            'url' => 'https://unique.test',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => $this->person->id,
            'venue_id' => $this->venue->id,
        ];

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_project')
            ->post('/inputform_project', $data);

        $response->assertRedirect('/inputform_project');
        $response->assertSessionHasErrors(['name', 'url']);
        $this->assertDatabaseCount('projects', 1);
    }

    public function test_store_handles_exception_and_redirects_with_error(): void
    {
        $data = [
            'name' => 'Exception Project',
            'description' => 'Desc',
            'url' => 'https://exception.test',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => $this->person->id,
            'venue_id' => $this->venue->id,
        ];

        Event::listen('eloquent.creating: '.Project::class, function () {
            throw new \Exception('db error');
        });

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/inputform_project')
            ->post('/inputform_project', $data);

        $response->assertRedirect('/inputform_project');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('projects', 0);
    }
}
