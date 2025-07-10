<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use App\Models\User;
use Faker\Factory;

class InputFormInstitutionTest extends TestCase
{
    use RefreshDatabase;
    protected $faker;

    private User $user;

    /**
     * This protected method sets up a Faker instance so that all tests can use this instance.
     * Helps to create truly unique values.
     */

    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();

        $this->user = User::factory()->create();
    }

    public function test_guest_is_redirected_from_create_route(): void
    {
        $response = $this->get('/institutions/create');
        $response->assertRedirect('/login');
    }

    public function test_guest_cannot_store_institution(): void
    {
        $record = [
            'name' => 'Test',
            'type' => Institution::TYPE_MANUFACTURER,
            'contact_information' => 'info'
        ];

        $response = $this->post('/institutions/create', $record);
        $response->assertRedirect('/login');
        $this->assertDatabaseCount('institutions', 0);
    }

    /**
     * Tests whether the institution input form view is accessible
     * and returns a successful HTTP response with the correct view.
     */
    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        $response = $this->actingAs(User::factory()->create())
            ->get('/institutions/create');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_institution');

    }

    /**
     * Tests that a valid institution record can be created via POST request
     * and the user is redirected to the input form afterwards.
     */
    public function test_store_creates_institution_and_redirects(): void
    {

        $record = [
            'name' => $this->faker->unique()->regexify('[a-zA-Z]{50}'),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => $this->faker->text(255)
        ];

        $response = $this->actingAs(User::factory()->create())
            ->withHeader('referer', '/institutions/create')
            ->post('/institutions/create', $record);

        $response->assertRedirect('/institutions/create');
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('institutions', [
            'name' => $record['name'],
            'type' => $record['type'],
            'contact_information' => $record['contact_information'],
        ]);

    }

    /**
     * Tests that a record with an overly long name fails validation,
     * does not get stored in the database and redirects with errors.
     */

    public function test_store_does_not_create_institution_because_of_too_long_string_and_redirects(): void
    {

        $record = [
            'name' => $this->faker->unique()->regexify('[a-zA-Z]{51}'),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => $this->faker->text(255)
        ];

        $response = $this->actingAs(User::factory()->create())
            ->withHeader('referer', '/institutions/create')
            ->post('/institutions/create', $record);

        $response->assertRedirect('/institutions/create');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }

    /**
     * Tests that a record with a missing required field (type) fails validation,
     * does not get stored in the database and redirects with appropriate errors.
     */

    public function test_store_does_not_create_institution_because_of_missing_type_in_record_array_and_redirects(): void
    {

        $record = [
            'name' => $this->faker->unique()->regexify('[a-zA-Z]{50}'),
            'type' => null,
            'contact_information' => $this->faker->text(255)
        ];

        $response = $this->actingAs(User::factory()->create())
            ->withHeader('referer', '/institutions/create')
            ->post('/institutions/create', $record);

        $response->assertRedirect('/institutions/create');
        $response->assertSessionHasErrors('type');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }


    /**
     * Tests that a record with a missing required field (contact_information) fails validation,
     * does not get stored in the database and redirects with appropriate errors.
     */

    public function test_store_does_not_create_institution_because_of_missing_contact_information_in_record_array_and_redirects(): void
    {

        $record = [
            'name' => $this->faker->unique()->regexify('[a-zA-Z]{50}'),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => null
        ];

        $response = $this->actingAs(User::factory()->create())
            ->withHeader('referer', '/institutions/create')
            ->post('/institutions/create', $record);

        $response->assertRedirect('/institutions/create');
        $response->assertSessionHasErrors('contact_information');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }
    /**
     * Tests that a record with an invalid value fails validation,
     * does not get stored in the database and redirects with appropriate errors.
     */

    public function test_store_does_not_create_institution_because_of_invalid_value_in_record_array_and_redirects(): void
    {


        $record = [
            'name' => $this->faker->unique()->regexify('[a-zA-Z]{50}'),
            'type' => 'EXAMPLE_TYPE',
            'contact_information' => $this->faker->text(255)
        ];

        $response = $this->actingAs(User::factory()->create())
            ->withHeader('referer', '/institutions/create')
            ->post('/institutions/create', $record);

        $response->assertRedirect('/institutions/create');
        $response->assertSessionHasErrors('type');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }
}
