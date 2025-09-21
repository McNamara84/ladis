<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Venue;
use App\Models\Location;
use Exception;
use Illuminate\Support\Facades\Event;

class LocationManagementTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    public function test_guest_is_redirected_from_protected_routes(): void
    {
        $this->get('/locations/all')->assertRedirect('/login');
        $this->get('/locations/create')->assertRedirect('/login');
        $this->post('/locations/create', [])->assertRedirect('/login');
    }

    public function test_index_displays_locations_with_related_venues(): void
    {
        $venue = Venue::factory()->create(['name' => 'Museum Insel']);
        $location = Location::factory()->for($venue)->create(['name' => 'Ausstellungshalle']);

        $response = $this->actingAs($this->user)->get('/locations/all');

        $response->assertOk();
        $response->assertViewIs('locations.index');
        $response->assertViewHasAll([
            'locations',
            'pageTitle',
        ]);
        $response->assertSeeText($location->name);
        $response->assertSeeText($venue->name);
    }

    public function test_create_route_displays_form_with_venues(): void
    {
        Venue::factory()->count(2)->create();

        $response = $this->actingAs($this->user)->get('/locations/create');

        $response->assertOk();
        $response->assertViewIs('inputform_location');
        $response->assertViewHas('venues');
        $response->assertSee('Neuen Standort anlegen', false);
    }

    public function test_store_creates_location_and_redirects_back_to_form(): void
    {
        $venue = Venue::factory()->create();

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/locations/create')
            ->post('/locations/create', [
                'name' => 'Restaurierungswerkstatt',
                'venue_id' => $venue->id,
            ]);

        $response->assertRedirect('/locations/create');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('locations', [
            'name' => 'Restaurierungswerkstatt',
            'venue_id' => $venue->id,
        ]);
    }

    public function test_store_requires_unique_name_per_venue(): void
    {
        $venue = Venue::factory()->create();
        Location::factory()->for($venue)->create(['name' => 'Depot']);

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/locations/create')
            ->post('/locations/create', [
                'name' => 'Depot',
                'venue_id' => $venue->id,
            ]);

        $response->assertRedirect('/locations/create');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('locations', 1);
    }

    public function test_store_requires_venue_to_exist(): void
    {
        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/locations/create')
            ->post('/locations/create', [
                'name' => 'Labor',
                'venue_id' => 999,
            ]);

        $response->assertRedirect('/locations/create');
        $response->assertSessionHasErrors('venue_id');
        $this->assertDatabaseCount('locations', 0);
    }

    public function test_store_handles_exceptions_and_returns_with_error_message(): void
    {
        $venue = Venue::factory()->create();

        Event::listen('eloquent.creating: ' . Location::class, function () {
            throw new Exception('db fail');
        });

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/locations/create')
            ->post('/locations/create', [
                'name' => 'Sicherheitsbereich',
                'venue_id' => $venue->id,
            ]);

        $response->assertRedirect('/locations/create');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('locations', 0);
    }

    public function test_destroy_deletes_location(): void
    {
        $location = Location::factory()->create();

        $response = $this->actingAs($this->user)
            ->from('/locations/all')
            ->delete('/locations/' . $location->id);

        $response->assertRedirect('/locations/all');
        $this->assertDatabaseCount('locations', 0);
    }
}
