<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_search_result_page_returns_successful_response(): void
    {
        $response = $this->get('/adv-search/result');

        $response->assertStatus(200);
        $response->assertViewIs('search.index');
    }
}
