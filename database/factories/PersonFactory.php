<?php

namespace Database\Factories;

use App\Models\Person;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Person Factory
 *
 * Generates fake data for Person model instances with unique names.
 * Used for testing and seeding.
 *
 * Features:
 * - Generates unique names using Faker's firstName and lastName methods
 * - Includes optional academic titles (Dr., Prof., M.A., etc.)
 * - Creates associated institutions automatically
 *
 * Usage examples:
 * ```php
 * // Create a person with a random institution
 * Person::factory()->create();
 *
 * // Create a person for an existing institution
 * Person::factory()->for($institution)->create();
 *
 * // Create multiple unique persons
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
            'name' => $this->generateUniqueName(),
            'institution_id' => Institution::factory(),
        ];
    }

    /**
     * Generate a unique name with optional academic titles
     *
     * Uses Faker's firstName and lastName methods combined with
     * custom titles to ensure consistent formatting and uniqueness.
     *
     * @return string
     */
    private function generateUniqueName(): string
    {
        $titles = [
            'Dr.',
            'Prof. Dr.',
            'Dipl.-Ing.',
            'M.A.',
            'B.A.',
            'M.Sc.',
            'Ph.D.',
            '', // No title (more common)
            '', // No title (more common)
            '', // No title (more common)
        ];

        // Generate unique first and last names separately to avoid title conflicts
        $firstName = $this->faker->unique()->firstName();
        $lastName = $this->faker->lastName();
        $title = $this->faker->randomElement($titles);

        $fullName = "$firstName $lastName";

        if (empty($title)) {
            return $fullName;
        }

        return "$title $fullName";
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
