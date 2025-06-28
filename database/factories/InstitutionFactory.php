<?php

namespace Database\Factories;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * Institution Factory
 *
 * Generates fake data for Institution model instances.
 * Used for testing and seeding.
 *
 * Usage examples:
 * ```php
 * // Create a random institution
 * Institution::factory()->create();
 *
 * // Create specific types
 * Institution::factory()->client()->create();
 * Institution::factory()->contractor()->create();
 * Institution::factory()->manufacturer()->create();
 *
 * // Create multiple institutions
 * Institution::factory()->count(10)->create();
 * ```
 *
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Institution>
 */
class InstitutionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Institution::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->generateInstitutionName(),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => $this->generateContactInformation(),
        ];
    }

    /**
     * Generate a realistic German institution name
     *
     * @return string
     */
    private function generateInstitutionName(): string
    {
        $prefixes = [
            'Institut für',
            'Zentrum für',
            'Forschungsinstitut',
            'Technisches',
            'Deutsches',
            'Bayerisches',
            'Berliner',
            'Münchener',
        ];

        $subjects = [
            'Denkmalpflege',
            'Restaurierung',
            'Kulturerbe',
            'Lasertechnik',
            'Oberflächenbehandlung',
            'Materialforschung',
            'Konservierung',
            'Kunstgeschichte',
        ];

        $suffixes = [
            'GmbH',
            'e.V.',
            'Institut',
            'Zentrum',
            'Gesellschaft',
            'Forschung',
        ];

        $prefix = $this->faker->randomElement($prefixes);
        $subject = $this->faker->randomElement($subjects);
        $suffix = $this->faker->randomElement($suffixes);

        return "$prefix $subject $suffix";
    }

    /**
     * Generate realistic contact information
     *
     * @return string
     */
    private function generateContactInformation(): string
    {
        $contactParts = [];

        // Add address
        $contactParts[] = $this->faker->streetAddress;
        $contactParts[] = "{$this->faker->postcode} {$this->faker->city}";

        // Add phone
        $contactParts[] = "Tel: {$this->faker->phoneNumber}";

        // Add email
        $contactParts[] = "E-Mail: {$this->faker->safeEmail}";

        // Optionally add website
        if ($this->faker->boolean(70)) {
            $contactParts[] = "Web: {$this->faker->url}";
        }

        return implode("\n", $contactParts);
    }

    /**
     * Create an institution of type "Auftraggeber" (Client)
     */
    public function client(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => Institution::TYPE_CLIENT,
        ]);
    }

    /**
     * Create an institution of type "Auftragnehmer" (Contractor)
     */
    public function contractor(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => Institution::TYPE_CONTRACTOR,
        ]);
    }

    /**
     * Create an institution of type "Hersteller" (Manufacturer)
     */
    public function manufacturer(): static
    {
        return $this->state(fn(array $attributes) => [
            'type' => Institution::TYPE_MANUFACTURER,
        ]);
    }
}
