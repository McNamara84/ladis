<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class PrivacyPolicyPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_privacy_policy_page_is_accessible(): void
    {
        $response = $this->get('/datenschutz');

        $response->assertStatus(200);
        $response->assertViewIs('privacy-policy');
        $response->assertSee('Datenschutzerkl');

        $formattedDate = Carbon::parse('2025-06-21T00:00:00Z')
            ->timezone('Europe/Berlin')
            ->format('d. F Y');
        $response->assertSee($formattedDate);
    }
}
