<?php

namespace Tests\Feature;

use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class LegalNoticePageTest extends TestCase
{
    private static ?TestResponse $response = null;

    private function getResponse(): TestResponse
    {
        if (static::$response === null) {
            static::$response = $this->get('/impressum');
        }

        return static::$response;
    }

    public function test_legal_notice_page_response_is_ok(): void
    {
        $response = $this->getResponse();

        $response->assertStatus(200);
    }

    public function test_legal_notice_page_uses_correct_view(): void
    {
        $response = $this->getResponse();

        $response->assertViewIs('legal_notice');
        $response->assertSee('Impressum');
    }

    public function test_legal_notice_page_loads_contact_information(): void
    {
        $response = $this->getResponse();

        $response->assertViewHas('supervisoryAuthority');
    }

    public function test_legal_notice_page_shows_date_updated_at(): void
    {
        $response = $this->getResponse();

        $response->assertViewHas('lastUpdated');
        $response->assertViewHas('lastUpdatedFormatted');

        $data = $response->getOriginalContent()->getData();
        $updatedAt = $data['lastUpdated'];
        $updatedAtReadable = $data['lastUpdatedFormatted'];

        $response->assertSeeHtmlInOrder([
            "datetime=\"$updatedAt\"",
            $updatedAtReadable
        ]);
    }
}
