<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;
use App\Models\Project;
use App\Models\Venue;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    private function createInstitution(): Institution
    {
        return Institution::create([
            'name' => fake()->company(),
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Send pigeon',
        ]);
    }

    private function createProject($person): Project
    {
        $venue = Venue::factory()->create();

        $project = new Project([
            'name' => fake()->name(),
            'description' => fake()->sentence(),
            'url' => fake()->url(),
            'started_at' => fake()->date(),
            'ended_at' => fake()->date(),
            'venue_id' => $venue->id,
        ]);

        // Assign relationships in a separate step because they are not fillable
        $project->person()->associate($person);
        $project->venue()->associate($venue);
        $project->save();

        return $project;
    }

    private function createProjects($person): array
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

    private function createPerson($institution): Person
    {
        return Person::create([
            'name' => fake()->name(),
            'institution_id' => $institution->id,
        ]);
    }

    public function test_person_record_can_be_created(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);

        $this->assertDatabaseHas('persons', [
            'name' => $person->name,
            'institution_id' => $institution->id,
        ]);
    }

    public function test_person_institution_relationship(): void
    {
        $institution = $this->createInstitution();
        $person = $this->createPerson($institution);

        $this->assertTrue($person->institution->is($institution));
    }

    public function test_person_projects_relationship(): void
    {
        $person = $this->createPerson($this->createInstitution());
        $projects = $this->createProjects($person);

        $this->assertTrue($person->projects->contains($projects[0]));
        $this->assertTrue($person->projects->contains($projects[1]));
        $this->assertFalse($person->projects->contains($projects[2]));
    }

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

    public function test_name_is_required(): void
    {
        $institution = $this->createInstitution();

        // Attempt to create person without name should fail
        $this->expectException(\Illuminate\Database\QueryException::class);

        Person::create([
            'institution_id' => $institution->id,
        ]);
    }
}
