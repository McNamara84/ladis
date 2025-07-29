<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LegalNoticePageTest extends TestCase
{
    public function test_legal_notice_page_is_accessible(): void
    {
        $response = $this->get('/impressum');

        $response->assertStatus(200);
        $response->assertViewIs('legal_notice');
        $response->assertSee('Impressum');
    }
}
