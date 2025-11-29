<?php

namespace Tests\Feature;

use App\Models\Artifact;
use App\Models\Device;
use App\Models\Image;
use App\Models\Institution;
use App\Models\Location;
use App\Models\Material;
use App\Models\PartialSurface;
use App\Models\Person;
use App\Models\Process;
use App\Models\Project;
use App\Models\SampleSurface;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ResourceShowPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_device_show_page_is_accessible(): void
    {
        $device = Device::factory()->create();

        $indexResponse = $this->get(route('devices.all'));
        $indexResponse->assertOk();
        $indexResponse->assertSee(route('devices.show', $device), false);

        $response = $this->get(route('devices.show', $device));
        $response->assertOk();
        $response->assertSeeText($device->name);
    }

    public function test_device_show_page_returns_not_found_for_missing_device(): void
    {
        $this->get('/devices/999')->assertNotFound();
    }

    public function test_material_show_page_is_accessible(): void
    {
        $material = Material::factory()->create();
        $coating = Material::factory()->create();
        PartialSurface::factory()->create([
            'foundation_material_id' => $material->id,
            'coating_material_id' => $coating->id,
        ]);

        $this->get(route('materials.all'))
            ->assertOk()
            ->assertSee(route('materials.show', $material), false);

        $this->get(route('materials.show', $material))
            ->assertOk()
            ->assertSeeText($material->name);
    }

    public function test_material_show_page_returns_not_found_for_missing_material(): void
    {
        $this->get('/materials/999')->assertNotFound();
    }

    public function test_institution_show_page_is_accessible(): void
    {
        $institution = Institution::factory()->create();
        Device::factory()->create(['institution_id' => $institution->id]);
        Person::factory()->create(['institution_id' => $institution->id]);

        $this->get(route('institutions.all'))
            ->assertOk()
            ->assertSee(route('institutions.show', $institution), false);

        $this->get(route('institutions.show', $institution))
            ->assertOk()
            ->assertSeeText($institution->name);
    }

    public function test_institution_show_page_returns_not_found_for_missing_institution(): void
    {
        $this->get('/institutions/999')->assertNotFound();
    }

    public function test_project_show_page_is_accessible(): void
    {
        $project = Project::factory()->create();
        Image::factory()->create([
            'project_id' => $project->id,
        ]);

        $this->get(route('projects.all'))
            ->assertOk()
            ->assertSee(route('projects.show', $project), false);

        $this->get(route('projects.show', $project))
            ->assertOk()
            ->assertSeeText($project->name);
    }

    public function test_project_show_page_returns_not_found_for_missing_project(): void
    {
        $this->get('/projects/999')->assertNotFound();
    }

    public function test_person_show_page_is_accessible(): void
    {
        $person = Person::factory()->create();
        Project::factory()->create(['person_id' => $person->id]);

        $this->get(route('persons.all'))
            ->assertOk()
            ->assertSee(route('persons.show', $person), false);

        $this->get(route('persons.show', $person))
            ->assertOk()
            ->assertSeeText($person->name);
    }

    public function test_person_show_page_returns_not_found_for_missing_person(): void
    {
        $this->get('/persons/999')->assertNotFound();
    }

    public function test_process_show_page_is_accessible(): void
    {
        $process = Process::factory()->create();
        Image::factory()->create([
            'condition_id' => $process->partialSurface->condition_id,
            'project_id' => Project::factory()->create()->id,
        ]);

        $this->get(route('processes.all'))
            ->assertOk()
            ->assertSee(route('processes.show', $process), false);

        $this->get(route('processes.show', $process))
            ->assertOk()
            ->assertSeeText('Prozess #' . $process->id);
    }

    public function test_process_show_page_returns_not_found_for_missing_process(): void
    {
        $this->get('/processes/999')->assertNotFound();
    }

    public function test_venue_show_page_is_accessible(): void
    {
        $venue = Venue::factory()->create();
        Location::factory()->create(['venue_id' => $venue->id]);
        Project::factory()->create(['venue_id' => $venue->id]);

        $this->get(route('venues.all'))
            ->assertOk()
            ->assertSee(route('venues.show', $venue), false);

        $this->get(route('venues.show', $venue))
            ->assertOk()
            ->assertSeeText($venue->name);
    }

    public function test_venue_show_page_returns_not_found_for_missing_venue(): void
    {
        $this->get('/venues/999')->assertNotFound();
    }

    public function test_artifact_show_page_is_accessible(): void
    {
        $artifact = Artifact::factory()->create();
        SampleSurface::factory()->create(['artifacts_id' => $artifact->id]);

        $this->get(route('artifacts.all'))
            ->assertOk()
            ->assertSee(route('artifacts.show', $artifact), false);

        $this->get(route('artifacts.show', $artifact))
            ->assertOk()
            ->assertSeeText($artifact->name);
    }

    public function test_artifact_show_page_returns_not_found_for_missing_artifact(): void
    {
        $this->get('/artifacts/999')->assertNotFound();
    }

    public function test_location_show_page_is_accessible(): void
    {
        $location = Location::factory()->create();
        Artifact::factory()->create(['location_id' => $location->id]);

        $this->get(route('locations.all'))
            ->assertOk()
            ->assertSee(route('locations.show', $location), false);

        $this->get(route('locations.show', $location))
            ->assertOk()
            ->assertSeeText($location->name);
    }

    public function test_location_show_page_returns_not_found_for_missing_location(): void
    {
        $this->get('/locations/999')->assertNotFound();
    }

    public function test_sample_surface_show_page_is_accessible(): void
    {
        $sampleSurface = SampleSurface::factory()->create();
        PartialSurface::factory()->create(['sample_surface_id' => $sampleSurface->id]);

        $this->get(route('sample_surfaces.all'))
            ->assertOk()
            ->assertSee(route('sample_surfaces.show', $sampleSurface), false);

        $this->get(route('sample_surfaces.show', $sampleSurface))
            ->assertOk()
            ->assertSeeText($sampleSurface->name);
    }

    public function test_sample_surface_show_page_returns_not_found_for_missing_sample_surface(): void
    {
        $this->get('/samplesurfaces/999')->assertNotFound();
    }

    public function test_partial_surface_show_page_is_accessible(): void
    {
        $partialSurface = PartialSurface::factory()->create();
        Process::factory()->create(['partial_surface_id' => $partialSurface->id]);

        $this->get(route('partial_surfaces.all'))
            ->assertOk()
            ->assertSee(route('partial_surfaces.show', $partialSurface), false);

        $this->get(route('partial_surfaces.show', $partialSurface))
            ->assertOk()
            ->assertSeeText('Teilfläche');
    }

    public function test_partial_surface_show_page_returns_not_found_for_missing_partial_surface(): void
    {
        $this->get('/partialsurfaces/999')->assertNotFound();
    }
}
