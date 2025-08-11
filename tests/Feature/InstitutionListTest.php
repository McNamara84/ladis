<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Institution;
use App\Models\User;

class InstitutionListTest extends TestCase
{
    use RefreshDatabase;

    public function test_all_list_page_displays_all_institutions_by_default(): void
    {
        Institution::factory()->manufacturer()->create();
        Institution::factory()->client()->create();
        Institution::factory()->contractor()->create();

        $response = $this->get('/institutions/all');

        $response->assertStatus(200);
        $response->assertViewIs('institutions.index');
        $institutions = $response->viewData('institutions');
        $this->assertCount(3, $institutions);
    }

    public function test_list_page_can_filter_clients(): void
    {
        Institution::factory()->client()->count(2)->create();
        Institution::factory()->manufacturer()->create();

        $response = $this->get('/institutions/all?type=clients');

        $response->assertStatus(200);
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_CLIENT));
    }

    public function test_list_page_can_filter_contractors(): void
    {
        Institution::factory()->contractor()->count(2)->create();
        Institution::factory()->manufacturer()->create();

        $response = $this->get('/institutions/all?type=contractors');

        $response->assertStatus(200);
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_CONTRACTOR));
    }

    public function test_list_page_can_filter_manufacturers(): void
    {
        Institution::factory()->manufacturer()->count(2)->create();
        Institution::factory()->client()->create();
        Institution::factory()->contractor()->create();

        $response = $this->get('/institutions/all?type=manufacturers');

        $response->assertStatus(200);
        $response->assertViewIs('institutions.index');
        $institutions = $response->viewData('institutions');
        $this->assertTrue($institutions->every(fn($i) => $i->type === Institution::TYPE_MANUFACTURER));
    }

    public function test_institution_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $institution = Institution::factory()->manufacturer()->create();

        $response = $this->actingAs($user)
            ->withHeader('referer', '/institutions/all?type=manufacturers')
            ->delete(route('institutions.destroy', $institution));

        $response->assertRedirect('/institutions/all?type=manufacturers');
        $this->assertModelMissing($institution);
    }

    public function test_guest_cannot_delete_institution(): void
    {
        $institution = Institution::factory()->create();

        $response = $this->delete(route('institutions.destroy', $institution));

        $response->assertRedirect('/login');
        $this->assertModelExists($institution);
    }

    public function test_guest_does_not_see_create_button(): void
    {
        Institution::factory()->create();

        $response = $this->get('/institutions/all');

        $response->assertStatus(200);
        $response->assertDontSee('Institution hinzufügen');
    }

    public function test_authenticated_user_sees_create_button(): void
    {
        Institution::factory()->create();
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/institutions/all');

        $response->assertStatus(200);
        $response->assertSee('Institution hinzufügen');
    }

    public function test_all_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/all');

        $response->assertViewHas('pageTitle', 'Alle Institutionen');
    }

    public function test_clients_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/all?type=clients');

        $response->assertViewHas('pageTitle', 'Alle Auftraggeber');
    }

    public function test_contractors_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/all?type=contractors');

        $response->assertViewHas('pageTitle', 'Alle Auftragnehmer');
    }

    public function test_manufacturers_list_page_passes_page_title(): void
    {
        $response = $this->get('/institutions/all?type=manufacturers');

        $response->assertViewHas('pageTitle', 'Alle Hersteller');
    }
}
