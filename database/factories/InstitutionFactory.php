<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Institution;

/**
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
            'name' => $this->faker->company(),
            'type' => $this->faker->randomElement(Institution::getTypes()),
            'contact_information' => $this->faker->optional()->paragraph(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    /**
     * State for universities
     */
    public function university(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => 'Universität ' . $this->faker->city(),
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Kontakt: ' . $this->faker->email(),
        ]);
    }

    /**
     * State for research institutes
     */
    public function researchInstitute(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->company() . ' Forschungsinstitut',
            'type' => Institution::TYPE_CONTRACTOR,
            'contact_information' => 'Kontakt: ' . $this->faker->email(),
        ]);
    }

    /**
     * State for museums
     */
    public function museum(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->city() . ' Museum',
            'type' => Institution::TYPE_CLIENT,
            'contact_information' => 'Kontakt: ' . $this->faker->email(),
        ]);
    }

    /**
     * State for restoration companies
     */
    public function restorationCompany(): static
    {
        return $this->state(fn (array $attributes) => [
            'name' => $this->faker->company() . ' Restaurierung GmbH',
            'type' => Institution::TYPE_CONTRACTOR,
            'contact_information' => 'Kontakt: ' . $this->faker->email(),
        ]);
    }
}
