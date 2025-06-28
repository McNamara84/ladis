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
            'name' => $this->generateUniqueInstitutionName(),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => $this->generateContactInformation(),
        ];
    }

    /**
     * Generate a unique realistic German institution name
     *
     * @return string
     */
    private function generateUniqueInstitutionName(): string
    {
        $baseName = $this->generateInstitutionName();

        // Add unique identifier to ensure uniqueness
        $uniqueId = $this->faker->unique()->numberBetween(1, 9999);

        return "$baseName ($uniqueId)";
    }

    /**
     * Get all possible prefixes for German institution names
     *
     * @return array<string>
     */
    private static function getInstitutionPrefixes(): array
    {
        return [
            'Institut für',
            'Zentrum für',
            'Forschungsinstitut',
            'Technisches',
            'Deutsches',
            'Bayerisches',
            'Berliner',
            'Münchener',
        ];
    }

    /**
     * Get all possible suffixes for German institution names
     *
     * @return array<string>
     */
    private static function getInstitutionSuffixes(): array
    {
        return [
            'GmbH',
            'e.V.',
            'Institut',
            'Zentrum',
            'Gesellschaft',
            'Forschung',
        ];
    }

    /**
     * Get all possible subjects for German institution names
     *
     * @return array<string>
     */
    private static function getInstitutionSubjects(): array
    {
        return [
            'Denkmalpflege',
            'Restaurierung',
            'Kulturerbe',
            'Lasertechnik',
            'Oberflächenbehandlung',
            'Materialforschung',
            'Konservierung',
            'Kunstgeschichte',
        ];
    }

    /**
     * Get all possible German institutional elements that can appear in generated names
     * This is used for testing to ensure generated names contain German elements
     *
     * @return array<string>
     */
    public static function getGermanInstitutionalElements(): array
    {
        // Return unique elements from prefixes and suffixes (not subjects, as they're content-specific)
        return array_unique(array_merge(
            self::getInstitutionPrefixes(),
            self::getInstitutionSuffixes()
        ));
    }

    /**
     * Generate a realistic German institution name base
     *
     * @return string
     */
    private function generateInstitutionName(): string
    {
        $prefix = $this->faker->randomElement(self::getInstitutionPrefixes());
        $subject = $this->faker->randomElement(self::getInstitutionSubjects());
        $suffix = $this->faker->randomElement(self::getInstitutionSuffixes());

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
