<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvancedSearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_federal_states(): void
    {
        $response = $this->get('/adv-search');

        $response->assertStatus(200);
        $response->assertViewIs('advanced_search');
        $response->assertViewHas('states');
        $states = $response->viewData('states');
        $this->assertCount(16, $states);
        $this->assertTrue($states->contains('name', 'Berlin'));
    }
}
