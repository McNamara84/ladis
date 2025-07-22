<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use App\Models\User;

class InstitutionListTest extends TestCase
{
    use RefreshDatabase;

    public function test_manufacturers_list_page_displays_only_manufacturers(): void
    {
        Institution::factory()->manufacturer()->count(2)->create();
        Institution::factory()->client()->create();
        Institution::factory()->contractor()->create();

        $response = $this->get('/institutions/manufacturers/all');

        $response->assertStatus(200);
        $response->assertViewIs('institutions.index');
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_MANUFACTURER));
    }

    public function test_clients_list_page_displays_only_clients(): void
    {
        Institution::factory()->client()->count(2)->create();
        Institution::factory()->manufacturer()->create();

        $response = $this->get('/institutions/clients/all');

        $response->assertStatus(200);
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_CLIENT));
    }

    public function test_contractors_list_page_displays_only_contractors(): void
    {
        Institution::factory()->contractor()->count(2)->create();
        Institution::factory()->manufacturer()->create();

        $response = $this->get('/institutions/contractors/all');

        $response->assertStatus(200);
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_CONTRACTOR));
    }

    public function test_institution_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $institution = Institution::factory()->manufacturer()->create();

        $response = $this->actingAs($user)
            ->withHeader('referer', '/institutions/manufacturers/all')
            ->delete(route('institutions.destroy', $institution));

        $response->assertRedirect('/institutions/manufacturers/all');
        $this->assertModelMissing($institution);
    }

    public function test_guest_cannot_delete_institution(): void
    {
        $institution = Institution::factory()->create();

        $response = $this->delete(route('institutions.destroy', $institution));

        $response->assertRedirect('/login');
        $this->assertModelExists($institution);
    }

    public function test_manufacturers_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/manufacturers/all');

        $response->assertViewHas('pageTitle', 'Alle Hersteller');
    }

    public function test_clients_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/clients/all');

        $response->assertViewHas('pageTitle', 'Alle Auftraggeber');
    }

    public function test_contractors_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/contractors/all');

        $response->assertViewHas('pageTitle', 'Alle Auftragnehmer');
    }
}
