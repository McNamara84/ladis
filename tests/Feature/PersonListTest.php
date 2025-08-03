<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Person;

class PersonListTest extends TestCase
{
    use RefreshDatabase;

    public function test_persons_list_page_displays_persons(): void
    {
        Person::factory()->count(2)->create();

        $response = $this->get('/persons/all');

        $response->assertStatus(200);
        $response->assertViewIs('persons.index');
        $response->assertViewHas('persons');
    }

    public function test_person_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $person = Person::factory()->create();

        $response = $this->actingAs($user)->delete(route('persons.destroy', $person));

        $response->assertRedirect(route('persons.all'));
        $this->assertModelMissing($person);
    }

    public function test_guest_cannot_delete_person(): void
    {
        $person = Person::factory()->create();

        $response = $this->delete(route('persons.destroy', $person));

        $response->assertRedirect('/login');
        $this->assertModelExists($person);
    }
}
