<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdvancedSearchControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that the advanced search page loads successfully
     */
    public function test_advanced_search_page_loads_successfully(): void
    {
        $response = $this->get('/advanced_search');

        $response->assertStatus(200);
        $response->assertViewIs('advanced_search');
        $response->assertViewHas('pageTitle', 'Suche');
        $response->assertViewHas('hasSearched', false);
        $response->assertViewHas('results', []);
    }
}
