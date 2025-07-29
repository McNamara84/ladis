<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Person;
use App\Models\Venue;

class ProjectInputRouteTest extends TestCase
{
    use RefreshDatabase;

    public function test_project_input_form_requires_authentication(): void
    {
        $response = $this->get('/inputform_project');

        $response->assertRedirect('/login');
    }

    public function test_project_input_view_is_displayed(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();
        $venue = Venue::factory()->create();

        $response = $this->actingAs($user)->get('/inputform_project');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_project');
        $response->assertViewHas('pageTitle', 'Neues Projekt anlegen');
        $response->assertViewHas('persons', function ($persons) use ($person) {
            return $persons->contains($person);
        });
        $response->assertViewHas('venues', function ($venues) use ($venue) {
            return $venues->contains($venue);
        });
    }
}
