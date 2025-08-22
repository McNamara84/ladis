<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\City;
use App\Models\User;
use App\Models\Venue;
use Illuminate\Support\Facades\Event;
use Exception;

class VenueCreateTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function test_guest_is_redirected_from_create_route(): void
    {
        $response = $this->get('/venues/create');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_venue(): void
    {
        $city = City::factory()->create();
        $record = [
            'name' => 'Guest Venue',
            'city_id' => $city->id,
        ];

        $response = $this->post('/venues/create', $record);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('venues', 0);
    }

    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        City::factory()->create();

        $response = $this->actingAs($this->user)->get('/venues/create');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_venue');
        $response->assertViewHas('cities');
        $response->assertViewHas('pageTitle', 'Eingabeformular - Ort - LADIS - FH Potsdam');
    }

    public function test_store_creates_venue_and_redirects(): void
    {
        $city = City::factory()->create();
        $name = 'New Venue';

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/venues/create')
            ->post('/venues/create', [
                'name' => $name,
                'city_id' => $city->id,
            ]);

        $response->assertRedirect('/venues/create');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('venues', [
            'name' => $name,
            'city_id' => $city->id,
        ]);
    }

    public function test_store_does_not_create_venue_because_of_missing_city(): void
    {
        $name = 'No City Venue';

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/venues/create')
            ->post('/venues/create', [
                'name' => $name,
                'city_id' => null,
            ]);

        $response->assertRedirect('/venues/create');
        $response->assertSessionHasErrors('city_id');
        $this->assertDatabaseMissing('venues', ['name' => $name]);
    }

    public function test_store_fails_when_name_not_unique_within_city(): void
    {
        $city = City::factory()->create();
        Venue::factory()->for($city)->create(['name' => 'Duplicate']);

        $record = [
            'name' => 'Duplicate',
            'city_id' => $city->id,
        ];

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/venues/create')
            ->post('/venues/create', $record);

        $response->assertRedirect('/venues/create');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('venues', 1);
    }

    public function test_store_handles_exception_and_redirects_back(): void
    {
        $city = City::factory()->create();

        Event::listen('eloquent.creating: '.Venue::class, function () {
            throw new Exception('db fail');
        });

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/venues/create')
            ->post('/venues/create', [
                'name' => 'Fail Venue',
                'city_id' => $city->id,
            ]);

        $response->assertRedirect('/venues/create');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('venues', 0);
    }
}
