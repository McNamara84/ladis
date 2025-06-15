<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class WelcomeTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     */
    public function testProjectNameOnWelcomePage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                ->waitForText('Laser-Projekt')
                ->assertSee('Laser-Projekt');
        });
    }
}
