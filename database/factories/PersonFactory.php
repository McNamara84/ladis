<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Person Factory
 *
 * Generates fake data for Person model instances.
 * Used for testing and seeding.
 *
 * Usage examples:
 * ```php
 * // Create a person with a random institution
 * Person::factory()->create();
 *
 * // Create a person for an existing institution
 * Person::factory()->for($institution)->create();
 *
 * // Create multiple persons
 * Person::factory()->count(5)->create();
 *
 * // Create a person with a specific institution type
 * Person::factory()->withClientInstitution()->create();
 * Person::factory()->withContractorInstitution()->create();
 * ```
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Person>
 */
class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Person::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->generateGermanName(),
            'institution_id' => Institution::factory(),
        ];
    }

    /**
     * Generate a realistic German name with academic titles
     *
     * @return string
     */
    private function generateGermanName(): string
    {
        $titles = [
            'Dr.',
            'Prof. Dr.',
            'Dipl.-Ing.',
            'M.A.',
            'B.A.',
            '', // No title
            '', // No title (more common)
            '', // No title (more common)
        ];

        $firstNames = [
            'Andreas',
            'Barbara',
            'Christian',
            'Diana',
            'Erik',
            'Franziska',
            'Georg',
            'Hannah',
            'Ingmar',
            'Julia',
            'Klaus',
            'Laura',
            'Martin',
            'Nina',
            'Oliver',
            'Petra',
            'Robert',
            'Sabine',
            'Thomas',
            'Ursula',
            'Viktor',
            'Waltraud',
            'Xaver',
            'Yvonne',
            'Zoe'
        ];

        $lastNames = [
            'Müller',
            'Schmidt',
            'Schneider',
            'Fischer',
            'Weber',
            'Meyer',
            'Wagner',
            'Becker',
            'Schulz',
            'Hoffmann',
            'Schäfer',
            'Koch',
            'Bauer',
            'Richter',
            'Klein',
            'Wolf',
            'Schröder',
            'Neumann',
            'Schwarz',
            'Zimmermann',
            'Braun',
            'Krüger',
            'Hofmann',
            'Hartmann',
            'Lange',
            'Schmitt',
            'Werner',
            'Schmitz',
            'Krause',
            'Meier'
        ];

        $title = $this->faker->randomElement($titles);
        $firstName = $this->faker->randomElement($firstNames);
        $lastName = $this->faker->randomElement($lastNames);

        if (empty($title)) {
            return "$firstName $lastName";
        }

        return "$title $firstName $lastName";
    }

    /**
     * Create a person associated with a client institution
     *
     * @return static
     */
    public function withClientInstitution(): static
    {
        return $this->for(Institution::factory()->client());
    }

    /**
     * Create a person associated with a contractor institution
     *
     * @return static
     */
    public function withContractorInstitution(): static
    {
        return $this->for(Institution::factory()->contractor());
    }

    /**
     * Create a person associated with a manufacturer institution
     *
     * @return static
     */
    public function withManufacturerInstitution(): static
    {
        return $this->for(Institution::factory()->manufacturer());
    }
}
