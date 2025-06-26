<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\FederalState;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\City>
 */
class CityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'federal_state_id' => FederalState::factory(),
            'name' => fake()->randomElement([
                'Berlin',
                'Hamburg',
                'München',
                'Köln',
                'Frankfurt am Main',
                'Stuttgart',
                'Düsseldorf',
                'Leipzig',
                'Dortmund',
                'Essen',
                'Bremen',
                'Dresden',
                'Hannover',
                'Nürnberg',
                'Duisburg',
                'Bochum',
                'Wuppertal',
                'Bielefeld',
                'Bonn',
                'Münster',
                'Mannheim',
                'Augsburg',
                'Wiesbaden',
                'Mönchengladbach',
                'Gelsenkirchen',
                'Aachen',
                'Braunschweig',
                'Chemnitz',
                'Kiel',
                'Krefeld',
                'Halle (Saale)',
                'Magdeburg',
                'Freiburg im Breisgau',
                'Oberhausen',
                'Lübeck',
                'Erfurt',
                'Mainz',
                'Rostock',
                'Kassel',
                'Hagen',
                'Potsdam'
            ]),
            'postal_code' => fake()->numerify('#####'),
        ];
    }
}
