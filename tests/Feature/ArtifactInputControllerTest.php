<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
#use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Location;

class ArtifactInputControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    /** @test */
    public function it_displays_the_artifact_input_form(): void
    {
        // Arrange: Eine Location mit zugehörigem Venue erstellen
        $location = Location::factory()->create([
            'name' => 'Kuppel',
        ]);
        $response = $this->get('/inputform_artifact');
        $response->assertViewIs('inputform_artifact');
        $response->assertViewHas('pageTitle', 'Objekt Eingabeformular');
        $response->assertViewHas('locations', function ($locations) use ($location) {
            return $locations->contains($location);
        });
    }
}
