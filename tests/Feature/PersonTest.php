<?php

namespace Tests\Feature;

use App\Models\Institution;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Person;

class PersonTest extends TestCase
{
    use RefreshDatabase;

    public function test_person_record_can_be_created(): void
    {
        $institution_id = Institution::create([
            'name' => 'Insta',
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Send pigeon',
        ])->id;

        $person = Person::create([
            'name' => 'Alice',
            'institution_id' => $institution_id,
        ]);

        $this->assertDatabaseHas('persons', [
            'name' => $person->name,
            'institution_id' => $institution_id,
        ]);
    }
}