<?php

namespace Tests\Feature;

use App\Http\Controllers\InstitutionController;
use App\Models\Institution;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Tests\TestCase;

class InstitutionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_returns_404_for_invalid_type(): void
    {
        Route::get('test/institutions', [InstitutionController::class, 'index']);

        $response = $this->get('test/institutions?type=invalid');

        $response->assertNotFound();
    }

    public function test_destroy_sets_flash_message(): void
    {
        $user = User::factory()->create();
        $institution = Institution::factory()->create();

        $response = $this->actingAs($user)
            ->withHeader('referer', '/institutions/all?type=manufacturers')
            ->delete(route('institutions.destroy', $institution));

        $response->assertRedirect('/institutions/all?type=manufacturers');
        $response->assertSessionHas('success', 'Institution wurde gelöscht.');
    }
}
