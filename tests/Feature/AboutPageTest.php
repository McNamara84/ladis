<?php

namespace Tests\Feature;

use Tests\TestCase;

class AboutPageTest extends TestCase
{
    public function test_about_page_response_is_ok(): void
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

    public function test_about_page_loads_contact_information(): void
    {
        $response = $this->get('/ladis');

        $response->assertViewHas('inlineContacts');
        $response->assertViewHas('projectContacts');
    }
}
