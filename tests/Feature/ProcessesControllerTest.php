<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Route;
use Mockery;
use App\Models\Process;
use App\Models\User;
use Tests\TestCase;

class ProcessesControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_processes_list_page_displays_processes(): void
    {
        Process::factory()->count(2)->create();

        $response = $this->get('/processes/all');

        $response->assertStatus(200);
        $response->assertViewIs('processes.index');
        $response->assertViewHas('processes');
    }

    public function test_processes_list_page_displays_no_processes_message_when_empty(): void
    {
        $response = $this->get('/processes/all');

        $response->assertStatus(200);
        $response->assertSee('Keine Prozesse vorhanden.');
    }

    public function test_process_can_be_deleted(): void
    {
        $user = User::factory()->create();
        $process = Process::factory()->create();

        $response = $this->actingAs($user)->delete(route('processes.destroy', $process));

        $response->assertRedirect(route('processes.all'));
        $response->assertSessionHas('success');
        $this->assertStringContainsString('Prozess wurde', $response->baseResponse->getSession()->get('success'));
        $this->assertModelMissing($process);
    }

    public function test_processes_destroy_handles_exception_and_redirects_with_error(): void
    {
        $user = User::factory()->create();
        $process = Process::factory()->create();

        // Mock the process model to throw an exception when deleted
        Route::bind('process', function ($value) use ($process) {
            $mock = Mockery::mock($process)->makePartial();
            $mock->shouldReceive('delete')->andThrow(new \Exception('Simulated DB failure'));
            return $mock;
        });

        $response = $this->actingAs($user)->delete(route('processes.destroy', $process));

        $response->assertRedirect(route('processes.all'));
        $response->assertSessionHas('error');
        $this->assertStringContainsString('Prozess konnte nicht gelöscht werden', session('error'));
        $this->assertModelExists($process);
    }

    public function test_guest_cannot_delete_process(): void
    {
        $process = Process::factory()->create();

        $response = $this->delete(route('processes.destroy', $process));

        $response->assertRedirect('/login');
        $this->assertModelExists($process);
    }

    public function test_authenticated_user_sees_create_and_delete_buttons(): void
    {
        $user = User::factory()->create();
        Process::factory()->create();

        $response = $this->actingAs($user)->get('/processes/all');

        $response->assertStatus(200);
        $response->assertSee("href=\"" . route('processes.create') . "\"", false);
        $response->assertSee("data-bs-target=\"#deleteProcess", false);
    }

    public function test_guest_does_not_see_create_or_delete_buttons(): void
    {
        Process::factory()->create();

        $response = $this->get('/processes/all');

        $response->assertStatus(200);
        $response->assertDontSee("href=\"" . route('processes.create') . "\"", false);
        $response->assertDontSee("data-bs-target=\"#deleteProcess", false);
    }
}
