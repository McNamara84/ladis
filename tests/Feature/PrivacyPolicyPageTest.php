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

        $response->assertViewHas('lastUpdated');
        $response->assertViewHas('lastUpdatedFormatted');

        $data = $response->getOriginalContent()->getData();
        $updatedAt = $data['lastUpdated'];
        $updatedAtReadable = $data['lastUpdatedFormatted'];

        $response->assertSeeHtmlInOrder([
            "datetime=\"$updatedAt\"",
            $updatedAtReadable
        ]);

        // Check if required contact information is loaded
        $response->assertViewHas('contactResponsible');
        $response->assertViewHas('contactPrivacy');
        $response->assertViewHas('contactHosting');
        $response->assertViewHas('contactLdabb');
        $response->assertViewHas('contactFhpKommunikation');
    }
}
