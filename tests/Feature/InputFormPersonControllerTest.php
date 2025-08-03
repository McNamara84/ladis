<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Person;
use App\Models\Institution;
use Faker\Factory;
use Illuminate\Support\Facades\Event;
use Exception;

class InputFormPersonControllerTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private $faker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->user = User::factory()->create();
    }

    protected function tearDown(): void
    {
        Event::forget('eloquent.creating: '.Person::class);
        parent::tearDown();
    }

    public function test_guest_is_redirected_from_create_route(): void
    {
        $response = $this->get('/persons/create');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_person(): void
    {
        $institution = Institution::factory()->create();
        $record = [
            'name' => 'Guest Person',
            'institution_id' => $institution->id,
        ];

        $response = $this->post('/persons/create', $record);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('persons', 0);
    }

    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        Institution::factory()->create();

        $response = $this->actingAs($this->user)->get('/persons/create');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_person');
        $response->assertViewHas('institutions');
        $response->assertViewHas('pageTitle', 'Eingabeformular - Person - LADIS - FH Potsdam');
    }

    public function test_store_creates_person_and_redirects(): void
    {
        $institution = Institution::factory()->create();
        $name = $this->faker->unique()->regexify('[a-zA-Z]{20}');

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/persons/create')
            ->post('/persons/create', [
                'name' => $name,
                'institution_id' => $institution->id,
            ]);

        $response->assertRedirect('/persons/create');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('persons', [
            'name' => $name,
            'institution_id' => $institution->id,
        ]);
    }

    public function test_store_does_not_create_person_because_of_too_long_string_and_redirects(): void
    {
        $institution = Institution::factory()->create();
        $name = str_repeat('A', 51);

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/persons/create')
            ->post('/persons/create', [
                'name' => $name,
                'institution_id' => $institution->id,
            ]);

        $response->assertRedirect('/persons/create');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('persons', ['name' => $name]);
    }

    public function test_store_does_not_create_person_because_of_missing_institution_and_redirects(): void
    {
        $name = $this->faker->unique()->regexify('[a-zA-Z]{20}');

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/persons/create')
            ->post('/persons/create', [
                'name' => $name,
                'institution_id' => null,
            ]);

        $response->assertRedirect('/persons/create');
        $response->assertSessionHasErrors('institution_id');
        $this->assertDatabaseMissing('persons', ['name' => $name]);
    }

    public function test_store_fails_when_name_is_not_unique(): void
    {
        $institution = Institution::factory()->create();
        $existing = Person::factory()->for($institution)->create();

        $record = [
            'name' => $existing->name,
            'institution_id' => $institution->id,
        ];

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/persons/create')
            ->post('/persons/create', $record);

        $response->assertRedirect('/persons/create');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseCount('persons', 1);
    }

    public function test_store_handles_exception_and_redirects_back(): void
    {
        $institution = Institution::factory()->create();

        Event::listen('eloquent.creating: '.Person::class, function () {
            throw new Exception('db fail');
        });

        $response = $this->actingAs($this->user)
            ->withHeader('referer', '/persons/create')
            ->post('/persons/create', [
                'name' => 'Test Person',
                'institution_id' => $institution->id,
            ]);

        $response->assertRedirect('/persons/create');
        $response->assertSessionHas('error');
        $this->assertDatabaseCount('persons', 0);
    }
}
