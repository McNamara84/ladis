<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    private function createInstitution(): Institution
    {
        return Institution::create([
            'name' => 'Insta',
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Send pigeon',
        ]);
    }

    public function test_person_record_can_be_created(): void
    {
        $institution = $this->createInstitution();

        $person = Person::create([
            'name' => 'Alice',
            'institution_id' => $institution->id,
        ]);

        $this->assertDatabaseHas('persons', [
            'name' => $person->name,
            'institution_id' => $institution->id,
        ]);
    }
}
