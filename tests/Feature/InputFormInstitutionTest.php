<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use Faker\Factory;

class InputFormInstitutionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Tests whether the institution input form view is accessible
     * and returns a successful HTTP response with the correct view.
     */
    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        $response = $this->get('/inputform_institution');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_institution');

    }

    /**
     * Tests that a valid institution record can be created via POST request
     * and the user is redirected to the input form afterwards.
     */
    public function test_store_creates_institution_and_redirects(): void
    {
        $faker = Factory::create();

        $record = [
            'name' => $faker->unique()->regexify('[a-zA-Z]{50}'),
            'type' => $faker->randomElement(Institution::getTypes()),
            'contact_information' => $faker->text(255)
        ];

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
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
        $faker = Factory::create();

        $record = [
            'name' => $faker->unique()->regexify('[a-zA-Z]{51}'),
            'type' => $faker->randomElement(Institution::getTypes()),
            'contact_information' => $faker->text(255)
        ];

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
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
        $faker = Factory::create();

        $record = [
            'name' => $faker->unique()->regexify('[a-zA-Z]{51}'),
            'type' => null,
            'contact_information' => $faker->text(255)
        ];

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
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
        $faker = Factory::create();

        $record = [
            'name' => $faker->unique()->regexify('[a-zA-Z]{51}'),
            'type' => $faker->randomElement(Institution::getTypes()),
            'contact_information' => null
        ];

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
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

        $faker = Factory::create();

        $record = [
            'name' => $faker->unique()->regexify('[a-zA-Z]{51}'),
            'type' => 'EXAMPLE_TYPE',
            'contact_information' => null
        ];

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
        $response->assertSessionHasErrors('type');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }
}

