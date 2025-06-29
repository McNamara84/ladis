<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;
use App\Models\Institution;

/**
 * PersonFactory Test
 *
 * Tests the PersonFactory's data generation capabilities including:
 * - Basic person creation with valid data
 * - Unique names
 * - Institution relationship handling
 * - Institution type-specific creation methods
 */
class PersonFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the factory creates valid persons with proper data structure
     */
    public function test_factory_creates_valid_person_with_required_fields(): void
    {
        $person = Person::factory()->create();

        // Test instance creation and database persistence
        $this->assertInstanceOf(Person::class, $person);
        $this->assertDatabaseHas('persons', ['id' => $person->id]);

        // Test required fields are present and valid
        $this->assertNotEmpty($person->name);
        $this->assertNotNull($person->institution_id);
        $this->assertInstanceOf(Institution::class, $person->institution);
    }

    /**
     * Test that multiple persons have unique names
     */
    public function test_factory_generates_unique_person_names(): void
    {
        $persons = Person::factory()->count(25)->create();
        $names = $persons->pluck('name')->toArray();

        // All names should be unique due to database constraint
        $uniqueNames = array_unique($names);
        $this->assertEquals(
            count($names),
            count($uniqueNames),
            'All person names should be unique'
        );
    }

    /**
     * Test that persons are associated with institutions
     */
    public function test_factory_creates_persons_with_institution_relationship(): void
    {
        $person = Person::factory()->create();

        // Should have an institution relationship
        $this->assertNotNull($person->institution_id);
        $this->assertInstanceOf(Institution::class, $person->institution);
        $this->assertDatabaseHas('institutions', ['id' => $person->institution_id]);
    }

    /**
     * Test that persons can be created for existing institutions
     */
    public function test_factory_can_create_person_for_existing_institution(): void
    {
        $institution = Institution::factory()->create();
        $person = Person::factory()->for($institution)->create();

        $this->assertEquals($institution->id, $person->institution_id);
        $this->assertTrue($person->institution->is($institution));
    }

    /**
     * Test the withClientInstitution() state method
     */
    public function test_with_client_institution_creates_person_with_client_institution(): void
    {
        $person = Person::factory()->withClientInstitution()->create();

        $this->assertEquals(Institution::TYPE_CLIENT, $person->institution->type);
    }

    /**
     * Test the withContractorInstitution() state method
     */
    public function test_with_contractor_institution_creates_person_with_contractor_institution(): void
    {
        $person = Person::factory()->withContractorInstitution()->create();

        $this->assertEquals(Institution::TYPE_CONTRACTOR, $person->institution->type);
    }

    /**
     * Test the withManufacturerInstitution() state method
     */
    public function test_with_manufacturer_institution_creates_person_with_manufacturer_institution(): void
    {
        $person = Person::factory()->withManufacturerInstitution()->create();

        $this->assertEquals(Institution::TYPE_MANUFACTURER, $person->institution->type);
    }
}
