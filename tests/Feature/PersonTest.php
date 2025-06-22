<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;
use App\Models\Project;
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

    private function createProject($name, $person): Project
    {
        $project = new Project([
            'name' => $name,
            'description' => 'Description of the project',
            'url' => 'https://foo.none',
            'started_at' => fake()->date(),
            'ended_at' => fake()->date(),
        ]);

        // Assign the person relationship in a separate step
        $project->person()->associate($person);
        $project->save();

        return $project;
    }

    private function createProjects($person): array
    {
        $other_person = $this->createPerson($this->createInstitution());

        return [
            // Associated with the person
            $this->createProject('Project Number 7', $person),
            $this->createProject('Project E', $person),
            // Not associated with the person
            $this->createProject('Project 2501', $other_person),
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
}
