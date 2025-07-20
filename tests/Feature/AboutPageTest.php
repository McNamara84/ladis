<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AboutPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_about_page_returns_successful_response(): void
    {
        $response = $this->get('/ladis');

        $response->assertStatus(200);
    }

    public function test_about_page_uses_about_view(): void
    {
        $response = $this->get('/ladis');

        $response->assertViewIs('site.about');
    }

    public function test_about_page_displays_heading(): void
    {
        $response = $this->get('/ladis');

        $response->assertSee('Über das Projekt');
    }
}
