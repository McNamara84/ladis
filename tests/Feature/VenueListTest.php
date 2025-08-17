<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Venue;
use App\Models\City;
use App\Models\FederalState;
use App\Models\User;

class VenueListTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_list_page_displays_all_venues_by_default(): void
    {
        Venue::factory()->count(3)->create();

        $response = $this->get('/venues/all');

        $response->assertStatus(200);
        $response->assertViewIs('venues.index');
        $venues = $response->viewData('venues');
        $this->assertCount(3, $venues);
    }

    public function test_list_page_can_filter_by_federal_state(): void
    {
        $stateA = FederalState::factory()->create();
        $stateB = FederalState::factory()->create();

        Venue::factory()->for(City::factory()->for($stateA))->count(2)->create();
        Venue::factory()->for(City::factory()->for($stateB))->create();

        $response = $this->get('/venues/all?federal_state=' . $stateA->id);

        $response->assertStatus(200);
        $venues = $response->viewData('venues');
        $this->assertTrue($venues->every(fn($v) => $v->city->federal_state_id === $stateA->id));
    }

    public function test_venue_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $venue = Venue::factory()->create();

        $response = $this->actingAs($user)
            ->withHeader('referer', '/venues/all')
            ->delete(route('venues.destroy', $venue));

        $response->assertRedirect('/venues/all');
        $this->assertModelMissing($venue);
    }

    public function test_guest_cannot_delete_venue(): void
    {
        $venue = Venue::factory()->create();

        $response = $this->delete(route('venues.destroy', $venue));

        $response->assertRedirect('/login');
        $this->assertModelExists($venue);
    }

    public function test_guest_does_not_see_create_button(): void
    {
        Venue::factory()->create();

        $response = $this->get('/venues/all');

        $response->assertStatus(200);
        $response->assertDontSee('Ort hinzufügen');
    }

    public function test_authenticated_user_sees_create_button(): void
    {
        Venue::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/venues/all');

        $response->assertStatus(200);
        $response->assertSee('Ort hinzufügen');
    }

    public function test_all_list_page_passes_page_title(): void
    {
        $response = $this->get('/venues/all');

        $response->assertViewHas('pageTitle', 'Alle Orte');
    }

    public function test_filtered_list_page_passes_page_title(): void
    {
        $state = FederalState::factory()->create();

        $response = $this->get('/venues/all?federal_state=' . $state->id);

        $response->assertViewHas('pageTitle', 'Alle Orte in ' . $state->name);
    }
}
