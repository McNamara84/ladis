<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_form_is__not_displayed(): void
    {
        $response = $this->get('/register');

        $response->assertStatus(404);
    }
}
