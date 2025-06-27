<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;
use App\Models\Project;
use App\Models\Venue;

/**
 * PersonTest
 *
 * Tests for the Person model functionality including:
 * - CRUD operations
 * - Relationships with Institution and Project models
 * - Validation rules and constraints
 * - Database integrity constraints
 */
class PersonTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a test institution
     *
     * @return Institution
     */
    private function createInstitution(): Institution
    {
        return Institution::create([
            'name' => fake()->company(),
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Send pigeon',
        ]);
    }

    /**
     * Create a test project associated with a person
     *
     * @param Person $person
     * @return Project
     */
    private function createProject(Person $person): Project
    {
        $venue = Venue::factory()->create();

        $project = new Project([
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'url' => fake()->url(),
            'started_at' => fake()->date(),
            'ended_at' => fake()->date(),
        ]);

        // Assign relationships in a separate step because they are not fillable
        $project->person()->associate($person);
        $project->venue()->associate($venue);
        $project->save();

        return $project;
    }

    /**
     * Create multiple test projects with different person associations
     *
     * @param Person $person
     * @return array<Project>
     */
    private function createProjects(Person $person): array
    {
        $other_person = $this->createPerson($this->createInstitution());

        return [
            // Associated with the person
            $this->createProject($person),
            $this->createProject($person),
            // Not associated with the person
            $this->createProject($other_person),
        ];
    }

    /**
     * Create a test person associated with an institution
     *
     * @param Institution $institution
     * @return Person
     */
    private function createPerson(Institution $institution): Person
    {
        return Person::create([
            'name' => fake()->name(),
            'institution_id' => $institution->id,
        ]);
    }

    /**
     * Test that a person record can be created successfully
     */
    public function test_person_record_can_be_created(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);

        $this->assertDatabaseHas('persons', [
            'name' => $person->name,
            'institution_id' => $institution->id,
        ]);
    }

    /**
     * Test the relationship between person and institution
     */
    public function test_person_institution_relationship(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);

        $this->assertTrue($person->institution->is($institution));
    }

    /**
     * Test the relationship between person and projects
     */
    public function test_person_projects_relationship(): void
    {
        $person = $this->createPerson($this->createInstitution());
        $projects = $this->createProjects($person);

        $this->assertTrue($person->projects->contains($projects[0]));
        $this->assertTrue($person->projects->contains($projects[1]));
        $this->assertFalse($person->projects->contains($projects[2]));
    }

    /**
     * Test that person names must be unique
     */
    public function test_person_name_must_be_unique(): void
    {
        $institution1 = $this->createInstitution();
        $institution2 = $this->createInstitution();

        $personName = 'Dr. John Doe';

        // Create first person with the name
        Person::create([
            'name' => $personName,
            'institution_id' => $institution1->id,
        ]);

        // Attempt to create second person with the same name should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Person::create([
            'name' => $personName,
            'institution_id' => $institution2->id,
        ]);
    }

    /**
     * Test name length validation behavior differs by database type
     */
    public function test_name_length_behavior_by_database_type(): void
    {
        $institution = $this->createInstitution();

        // Create a name that exceeds 50 characters
        $longName = str_repeat('A', 51); // 51 characters

        $dbConnection = config('database.default');

        if ($dbConnection === 'sqlite') {
            // SQLite allows strings longer than VARCHAR length specification
            $person = Person::create([
                'name' => $longName,
                'institution_id' => $institution->id,
            ]);

            // In SQLite, the full 51-character name is stored (no truncation)
            $this->assertEquals(51, strlen($person->fresh()->name));
            $this->assertEquals($longName, $person->fresh()->name);
        } else {
            // MySQL/PostgreSQL should enforce length constraints
            $this->expectException(\Illuminate\Database\QueryException::class);

            Person::create([
                'name' => $longName,
                'institution_id' => $institution->id,
            ]);
        }
    }

    /**
     * Test that name field is required
     */
    public function test_name_is_required(): void
    {
        $institution = $this->createInstitution();

        // Attempt to create person without name should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Person::create([
            'institution_id' => $institution->id,
        ]);
    }

    /**
     * Test that institution_id field is required
     */
    public function test_institution_id_is_required(): void
    {
        // Attempt to create person without institution_id should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Person::create([
            'name' => 'Dr. Jane Smith',
        ]);
    }

    /**
     * Test that invalid institution_id values are rejected
     */
    public function test_invalid_institution_id_is_rejected(): void
    {
        // Attempt to create person with non-existent institution_id should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Person::create([
            'name' => 'Dr. John Smith',
            'institution_id' => 999, // Non-existent institution ID
        ]);
    }

    /**
     * Test that institutions cannot be deleted when persons exist
     */
    public function test_institution_cannot_be_deleted_when_persons_exist(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);

        // Attempt to delete institution with associated persons should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        $institution->delete();
    }

    /**
     * Test that id field is protected from mass assignment
     */
    public function test_id_field_is_protected_from_mass_assignment(): void
    {
        $institution = $this->createInstitution();

        // Attempt to create person with explicit ID value
        $person = Person::create([
            'id' => 999,
            'name' => 'Dr. Test Person',
            'institution_id' => $institution->id,
        ]);

        // The ID should be auto-assigned by database, not the value we tried to set
        $this->assertNotEquals(999, $person->id);
        $this->assertIsInt($person->id);
        $this->assertGreaterThan(0, $person->id);
    }

    /**
     * Test that timestamps are set automatically
     */
    public function test_timestamps_are_set_automatically(): void
    {
        $institution = $this->createInstitution();

        // Create person and verify timestamps are set
        $person = Person::create([
            'name' => 'Dr. Timestamp Test',
            'institution_id' => $institution->id,
        ]);

        $this->assertNotNull($person->created_at);
        $this->assertNotNull($person->updated_at);
        $this->assertEquals($person->created_at, $person->updated_at);

        // Sleep briefly to ensure timestamp difference
        sleep(1);

        // Update person and verify updated_at changes while created_at remains the same
        $originalCreatedAt = $person->created_at;
        $person->update(['name' => 'Dr. Updated Name']);

        $this->assertEquals($originalCreatedAt, $person->created_at);
        $this->assertGreaterThan($originalCreatedAt, $person->updated_at);
    }

    /**
     * Test that persons cannot be deleted when projects exist
     */
    public function test_person_cannot_be_deleted_when_projects_exist(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);
        $project = $this->createProject($person);

        // Attempt to delete person with associated projects should fail
        $this->expectException(\Illuminate\Database\QueryException::class);
        $person->delete();
    }
}
