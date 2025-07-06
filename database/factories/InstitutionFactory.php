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
     * @var string
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
     * Generate realistic contact information with varying completeness
     *
     * Can be empty or contain different combinations of:
     * - Address (street + city)
     * - Phone number
     * - Email address
     * - Website URL
     * - Fax number
     *
     * @return string
     */
    private function generateContactInformation(): string
    {
        $contactParts = [];

        // 10% chance of completely empty contact information
        if ($this->faker->boolean(10)) {
            return '';
        }

        // Each contact element has its own probability of being included

        // Address (70% chance) - if included, always has both street and city
        if ($this->faker->boolean(70)) {
            $contactParts[] = $this->faker->streetAddress;
            $contactParts[] = "{$this->faker->postcode} {$this->faker->city}";
        }

        // Phone number (60% chance)
        if ($this->faker->boolean(60)) {
            $phoneFormats = [
                "Tel: {$this->faker->phoneNumber}",
                "Telefon: {$this->faker->phoneNumber}",
                "Tel.: {$this->faker->phoneNumber}",
            ];
            $contactParts[] = $this->faker->randomElement($phoneFormats);
        }

        // Email address (75% chance)
        if ($this->faker->boolean(75)) {
            $emailFormats = [
                "E-Mail: {$this->faker->safeEmail}",
                "Email: {$this->faker->safeEmail}",
                "Mail: {$this->faker->safeEmail}",
            ];
            $contactParts[] = $this->faker->randomElement($emailFormats);
        }

        // Website (45% chance)
        if ($this->faker->boolean(45)) {
            $webFormats = [
                "Web: {$this->faker->url}",
                "Website: {$this->faker->url}",
                "Internet: {$this->faker->url}",
                $this->faker->url, // Just the URL without prefix
            ];
            $contactParts[] = $this->faker->randomElement($webFormats);
        }

        // Fax number (25% chance) - less common nowadays
        if ($this->faker->boolean(25)) {
            $faxFormats = [
                "Fax: {$this->faker->phoneNumber}",
                "Telefax: {$this->faker->phoneNumber}",
            ];
            $contactParts[] = $this->faker->randomElement($faxFormats);
        }

        // Mobile number (30% chance) - additional to landline
        if ($this->faker->boolean(30)) {
            $mobileFormats = [
                "Mobil: {$this->faker->phoneNumber}",
                "Mobile: {$this->faker->phoneNumber}",
                "Handy: {$this->faker->phoneNumber}",
            ];
            $contactParts[] = $this->faker->randomElement($mobileFormats);
        }

        // If somehow no contact parts were added (very unlikely), add at least email
        if (empty($contactParts)) {
            $contactParts[] = "E-Mail: {$this->faker->safeEmail}";
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
