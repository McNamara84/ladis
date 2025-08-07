<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Institution;

class SearchFilterCollapseTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_results_page_contains_collapsible_filter_toggle(): void
    {
        $response = $this->get('/adv-search/result');

        $response->assertStatus(200);

        $html = $response->getContent();

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $toggle = $dom->getElementById('searchFiltersToggle');
        $this->assertNotNull($toggle);
        $this->assertEquals('button', $toggle->tagName);
        $this->assertEquals('collapse', $toggle->getAttribute('data-bs-toggle'));
        $this->assertEquals('#searchFilters', $toggle->getAttribute('data-bs-target'));
        $this->assertEquals('searchFilters', $toggle->getAttribute('aria-controls'));
        $this->assertEquals('false', $toggle->getAttribute('aria-expanded'));
        $this->assertEquals('Filter einblenden', $toggle->getAttribute('aria-label'));
    }

    public function test_search_results_page_contains_filter_region(): void
    {
        $response = $this->get('/adv-search/result');

        $response->assertStatus(200);

        $html = $response->getContent();

        $dom = new \DOMDocument();
        libxml_use_internal_errors(true);
        $dom->loadHTML($html);
        libxml_clear_errors();

        $filters = $dom->getElementById('searchFilters');
        $this->assertNotNull($filters);
        $this->assertStringContainsString('collapse', $filters->getAttribute('class'));
        $this->assertEquals('region', $filters->getAttribute('role'));
        $this->assertEquals('searchFiltersToggle', $filters->getAttribute('aria-labelledby'));
    }
}
