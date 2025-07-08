<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\PartialSurface;
use App\Models\Device;
use App\Models\Configuration;
use App\Models\Process;

class ProcessInputControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_empty_form_can_not_be_saved(): void
    {
        $response = $this->post('/inputform_process', [
            'partial_surface_id' => '',
            'device_id' => '',
            'configuration_id' => '',
            'description' => '',
            'duration' => '',
            'wet' => '',
        ]);

        $response->assertSessionHasErrors([
            'partial_surface_id',
            'device_id',
            'configuration_id',
            'duration',
            'wet',
        ]);
    }
}