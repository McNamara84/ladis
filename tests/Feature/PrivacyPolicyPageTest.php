<?php

namespace Tests\Feature;

use Tests\TestCase;
use Carbon\Carbon;

class PrivacyPolicyPageTest extends TestCase
{
    public function test_privacy_policy_page_response_is_ok(): void
    {
        $response = $this->get('/datenschutz');

        $response->assertStatus(200);
        $response->assertViewIs('privacy-policy');
        $response->assertSee('Datenschutzerkl');

        $formattedDate = Carbon::parse('2025-06-21T00:00:00Z')
            ->timezone('Europe/Berlin')
            ->format('d. F Y');
        $response->assertSee($formattedDate);

        // Check if required contact information is loaded
        $response->assertViewHas('contactResponsible');
        $response->assertViewHas('contactPrivacy');
        $response->assertViewHas('contactHosting');
        $response->assertViewHas('contactLdabb');
        $response->assertViewHas('contactFhpKommunikation');
    }
}
