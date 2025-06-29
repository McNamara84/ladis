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
}
