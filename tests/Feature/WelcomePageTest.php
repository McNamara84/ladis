<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_welcome_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_welcome_page_uses_welcome_view(): void
    {
        $response = $this->get('/');

        $response->assertViewIs('welcome');
    }
}
