<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Location;
use App\Models\Artifact;
use App\Models\User;
use Exception;

class ArtifactInputControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Artifact::flushEventListeners();
        Artifact::clearBootedModels();
        parent::tearDown();
    }

    public function test_guest_is_redirected_from_input_form(): void
    {
        $response = $this->get('/inputform_artifact');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_artifact(): void
    {
        $location = Location::factory()->create();

        $response = $this->post('/inputform_artifact', [
            'artifact_name' => 'Gastobjekt',
            'artifact_location_id' => $location->id,
            'artifact_inventory_number' => 'INV-123',
        ]);

        $response->assertRedirect('/login');
        $this->assertDatabaseCount('artifacts', 0);
    }

    public function test_it_displays_the_artifact_input_form(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        // Arrange: A location is created to be used in the test
        $location = Location::factory()->create([
            'name' => 'Kuppel',
        ]);
        $response = $this->get('/inputform_artifact');
        $response->assertViewIs('inputform_artifact');
        $response->assertViewHas('pageTitle', 'Objekt Eingabeformular');
        $response->assertViewHas('locations', function ($locations) use ($location) {
            return $locations->contains($location);
        });
    }
    public function test_store_creates_artifact_and_redirects(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = Location::factory()->create();
        $name = 'Stuhl';
        $location_id = $location->id;
        $inventory_number = 'A12345';

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => $name,
                'artifact_location_id' => $location_id,
                'artifact_inventory_number' => $inventory_number,
            ]);

        $response->assertRedirect(route('artifacts.all'));
        $this->assertDatabaseHas('artifacts', [
            'name' => $name,
            'location_id' => $location_id,
            'inventory_number' => $inventory_number,
        ]);

        $artifact = Artifact::where('name', $name)->first();
        $this->assertNotNull($artifact);
    }

    public function test_store_does_not_create_artifact_and_redirects(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $name_non = '';
        $location_id_non = null;

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => $name_non,
                'artifact_location_id' => $location_id_non,
            ]);

        $response->assertRedirect('/inputform_artifact');
        $response->assertSessionHasErrors('artifact_name');
        $this->assertDatabaseMissing('artifacts', [
            'name' => $name_non,
            'location_id' => $location_id_non,
        ]);
    }
    public function test_required_data_is_missing_artifact_name_and_redirects(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $name_non = null;

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => $name_non,
                'artifact_location_id' => $name_non,
                'artifact_inventory_number' => $name_non,
            ]);

        $response->assertRedirect('/inputform_artifact');
        $response->assertSessionHasErrors('artifact_name');
    }
    public function test_form_submission_returns_redirect(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = Location::factory()->create();

        $response = $this->post('/inputform_artifact', [
            'artifact_name' => 'Testobjekt',
            'artifact_location_id' => $location->id,
            'artifact_inventory_number' => 'INV-001',
        ]);

        $response->assertStatus(302); // 302 = Redirect (form has been sent)
        $response->assertRedirect(route('artifacts.all'));
    }

    public function test_store_creates_artifact_without_inventory_number(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = Location::factory()->create();

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => 'Bank',
                'artifact_location_id' => $location->id,
                'artifact_inventory_number' => null,
            ]);

        $response->assertRedirect(route('artifacts.all'));
        $this->assertDatabaseHas('artifacts', [
            'name' => 'Bank',
            'location_id' => $location->id,
            'inventory_number' => null,
        ]);
    }

    public function test_store_fails_with_duplicate_name(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = Location::factory()->create();

        Artifact::factory()->create([
            'name' => 'Chair',
            'location_id' => $location->id,
        ]);

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => 'Chair',
                'artifact_location_id' => $location->id,
                'artifact_inventory_number' => 'INV-002',
            ]);

        $response->assertRedirect('/inputform_artifact');
        $response->assertSessionHasErrors('artifact_name');
        $this->assertDatabaseCount('artifacts', 1);
    }

    public function test_store_handles_exception_during_creation(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $location = Location::factory()->create();

        Artifact::creating(function () {
            throw new Exception('fail');
        });

        $response = $this->withHeader('referer', '/inputform_artifact')
            ->post('/inputform_artifact', [
                'artifact_name' => 'ErrObj',
                'artifact_location_id' => $location->id,
                'artifact_inventory_number' => 'INV-999',
            ]);

        $response->assertRedirect('/inputform_artifact');
        $response->assertSessionHas('error');
    }
}
