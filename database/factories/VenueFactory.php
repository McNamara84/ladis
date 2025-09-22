<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\City;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venue>
 */
class VenueFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'city_id' => City::factory(),
            'name' => sprintf('%s %s',
                fake()->randomElement([
                'Kölner Dom',
                'Schloss Bellevue',
                'Brandenburger Tor',
                'Aachener Dom',
                'Berliner Fernsehturm',
                'Frauenkirche Dresden',
                'Schloss Neuschwanstein',
                'Reichstagsgebäude',
                'Münchner Frauenkirche',
                'Hamburger Michel',
                'Schloss Sanssouci',
                'Wartburg',
                'Speicherstadt Hamburg',
                'Münster zu Ulm',
                'Schloss Heidelberg',
                'Kaiser-Wilhelm-Gedächtniskirche',
                'Semperoper Dresden',
                'Holstentor Lübeck',
                'Paulskirche Frankfurt',
                'Schloss Charlottenburg',
                'Marienplatz München',
                'Alte Oper Frankfurt',
                'Zwinger Dresden',
                'Nürnberger Kaiserburg',
                'Völkerschlachtdenkmal Leipzig'
            ]),
            fake()->unique()->numerify('#%03d')
            ),
        ];
    }
}
