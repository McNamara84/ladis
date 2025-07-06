<?php

namespace Tests\Feature;

use Database\Factories\InstitutionFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PhpOption\None;
use Tests\TestCase;
use App\Models\Institution;
class InputFormInstitutionTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_view_is_displayed_and_route_returns_successful_response(): void
    {
        $response = $this->get('/inputform_institution');

        $response->assertStatus(200);
        $response->assertViewIs('inputform_institution');

    }

    public function test_store_creates_institution_and_redirects(): void
    {
        $record = Institution::factory()->make()->toArray();

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
        $this->assertDatabaseHas('institutions', [
            'name' => $record['name'],
            'type' => $record['type'],
            'contact_information' => $record['contact_information'],
        ]);
    }

    public function test_store_does_not_create_institution_because_of_too_long_string_and_redirects(): void
    {
        $record = Institution::factory()->make(
            [
                'name' => 'THISSTRINGISTOOLONGTHISSTRINGISTOOLONGTHISSTRIN',
            ]
        )->toArray();

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
        $response->assertSessionHasErrors('name');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }

    public function test_store_does_not_create_institution_because_of_missing_value_in_record_array_and_redirects(): void
    {
        $record = Institution::factory()->make(
            [
                'type' => null,
            ]
        )->toArray();

        $response = $this->withHeader('referer', '/inputform_institution')
            ->post('/inputform_institution', $record);

        $response->assertRedirect('/inputform_institution');
        $response->assertSessionHasErrors('type');
        $this->assertDatabaseMissing('institutions', [
            'name' => $record['name'],
        ]);
    }
}
