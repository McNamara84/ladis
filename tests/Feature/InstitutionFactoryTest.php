<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use Database\Factories\InstitutionFactory;

/**
 * InstitutionFactory Test
 *
 * Tests the InstitutionFactory's data generation capabilities
 * and ensures all custom logic produces valid, well-formatted data
 */
class InstitutionFactoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the factory creates valid institutions with proper data structure
     */
    public function test_factory_creates_valid_institution_with_required_fields(): void
    {
        $institution = Institution::factory()->create();

        // Test instance creation and database persistence
        $this->assertInstanceOf(Institution::class, $institution);
        $this->assertDatabaseHas('institutions', ['id' => $institution->id]);

        // Test required fields are present and valid
        $this->assertNotEmpty($institution->name);
        $this->assertNotEmpty($institution->type);
        $this->assertContains($institution->type, Institution::getTypes());
    }

    /**
     * Test that generated names follow German institution naming conventions
     */
    public function test_factory_generates_proper_german_institution_names(): void
    {
        $institutions = Institution::factory()->count(10)->create();

        foreach ($institutions as $institution) {
            // Name should contain at least two words
            $this->assertGreaterThanOrEqual(2, str_word_count($institution->name));

            // Name should contain unique ID in parentheses at the end
            $this->assertMatchesRegularExpression(
                '/\(\d+\)$/',
                $institution->name,
                "Institution name '{$institution->name}' should end with unique ID in parentheses"
            );

            // Name should contain typical German institution components
            $germanElements = InstitutionFactory::getGermanInstitutionalElements();
            $hasGermanElements = false;

            foreach ($germanElements as $element) {
                if (str_contains($institution->name, $element)) {
                    $hasGermanElements = true;
                    break;
                }
            }

            $this->assertTrue(
                $hasGermanElements,
                "Institution name '{$institution->name}' should contain German elements"
            );
        }
    }

    /**
     * Test that multiple institutions have unique names (database constraint)
     */
    public function test_factory_generates_unique_institution_names(): void
    {
        $institutions = Institution::factory()->count(10)->create();
        $names = $institutions->pluck('name')->toArray();

        // All names should be unique due to database constraint
        $uniqueNames = array_unique($names);
        $this->assertEquals(
            count($names),
            count($uniqueNames),
            'All institution names should be unique'
        );
    }

    /**
     * Test that contact information varies across different institutions
     */
    public function test_factory_generates_varied_contact_information(): void
    {
        $institutions = Institution::factory()->count(20)->create();
        $contactInfoValues = $institutions->pluck('contact_information')->toArray();

        // Should have multiple different contact information values
        $uniqueValues = array_unique($contactInfoValues);
        $this->assertGreaterThan(1, count($uniqueValues), 'Factory should generate different contact information across institutions');
    }

    /**
     * Test the client() state method
     */
    public function test_client_state_creates_client_institution(): void
    {
        $institution = Institution::factory()->client()->create();

        $this->assertEquals(Institution::TYPE_CLIENT, $institution->type);
    }

    /**
     * Test the contractor() state method
     */
    public function test_contractor_state_creates_contractor_institution(): void
    {
        $institution = Institution::factory()->contractor()->create();

        $this->assertEquals(Institution::TYPE_CONTRACTOR, $institution->type);
    }

    /**
     * Test the manufacturer() state method
     */
    public function test_manufacturer_state_creates_manufacturer_institution(): void
    {
        $institution = Institution::factory()->manufacturer()->create();

        $this->assertEquals(Institution::TYPE_MANUFACTURER, $institution->type);
    }
}
