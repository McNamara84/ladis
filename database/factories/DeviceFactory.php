<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Device;
use App\Models\Institution;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Device>
 */
class DeviceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'institution_id' => Institution::factory(),
            'name' => $this->faker->unique()->bothify('Device-??##'),
            'description' => $this->faker->optional()->paragraph(),
            'year' => $this->faker->numberBetween(2000, 2024),
            'build' => $this->faker->randomElement([Device::BUILD_FIBER, Device::BUILD_MIRROR_ARM]),
            'safety_class' => $this->faker->numberBetween(1, 4),
            'height' => $this->faker->numberBetween(500, 2000),
            'width' => $this->faker->numberBetween(300, 1500),
            'depth' => $this->faker->numberBetween(200, 1000),
            'weight' => $this->faker->randomFloat(2, 10, 999),
            'fiber_length' => $this->faker->randomFloat(2, 1, 50),
            'cooling' => $this->faker->randomElement([0, 1]), // 0: intern, 1: extern
            'mounting' => $this->faker->boolean(),
            'automation' => $this->faker->boolean(),
            'max_output' => $this->faker->randomFloat(2, 10, 1000),
            'mean_output' => $this->faker->randomFloat(2, 5, 500),
            'max_wattage' => $this->faker->randomFloat(2, 100, 5000),
            'head' => $this->faker->optional()->bothify('Optik-??##'),
            'emission_source' => $this->faker->numberBetween(0, 2),
            'beam_type' => $this->faker->randomElement([Device::BEAM_POINT, Device::BEAM_LINE, Device::BEAM_AREA]),
            'beam_profile' => $this->faker->optional()->randomElement([
                'Top-Hat-Strahlprofil',
                'Gauß-Profil', 
                'Flach-Top-Profil',
                'Ringprofil'
            ]),
            'wavelength' => $this->faker->randomFloat(1, 800, 2000),
            'min_spot_size' => $this->faker->randomFloat(2, 0.1, 1),
            'max_spot_size' => $this->faker->randomFloat(2, 2, 10),
            'min_pf' => $this->faker->randomFloat(2, 0.1, 10),
            'max_pf' => $this->faker->randomFloat(2, 50, 1000),
            'min_pw' => $this->faker->randomFloat(2, 0.1, 5),
            'max_pw' => $this->faker->randomFloat(2, 10, 100),
            'min_scan_width' => $this->faker->randomFloat(2, 5, 50),
            'max_scan_width' => $this->faker->randomFloat(2, 100, 500),
            'min_focal_length' => $this->faker->randomFloat(2, 10, 100),
            'max_focal_length' => $this->faker->randomFloat(2, 200, 1000),
            'last_edit_by' => User::factory(),
        ];
    }

    /**
     * State for fiber optic devices
     */
    public function fiberOptic(): static
    {
        return $this->state(fn (array $attributes) => [
            'build' => Device::BUILD_FIBER,
            'fiber_length' => $this->faker->randomFloat(2, 5, 20),
        ]);
    }

    /**
     * State for mirror arm devices
     */
    public function mirrorArm(): static
    {
        return $this->state(fn (array $attributes) => [
            'build' => Device::BUILD_MIRROR_ARM,
            'fiber_length' => null, // Mirror arm devices might not have fiber
        ]);
    }

    /**
     * State for point lasers
     */
    public function pointLaser(): static
    {
        return $this->state(fn (array $attributes) => [
            'beam_type' => Device::BEAM_POINT,
            'min_spot_size' => $this->faker->randomFloat(2, 0.1, 0.5),
            'max_spot_size' => $this->faker->randomFloat(2, 1, 3),
        ]);
    }

    /**
     * State for line lasers
     */
    public function lineLaser(): static
    {
        return $this->state(fn (array $attributes) => [
            'beam_type' => Device::BEAM_LINE,
            'min_scan_width' => $this->faker->randomFloat(2, 10, 30),
            'max_scan_width' => $this->faker->randomFloat(2, 50, 200),
        ]);
    }

    /**
     * State for area lasers
     */
    public function areaLaser(): static
    {
        return $this->state(fn (array $attributes) => [
            'beam_type' => Device::BEAM_AREA,
            'min_scan_width' => $this->faker->randomFloat(2, 20, 50),
            'max_scan_width' => $this->faker->randomFloat(2, 100, 500),
        ]);
    }

    /**
     * State for high-power devices
     */
    public function highPower(): static
    {
        return $this->state(fn (array $attributes) => [
            'max_output' => $this->faker->randomFloat(2, 500, 2000),
            'mean_output' => $this->faker->randomFloat(2, 300, 1500),
            'max_wattage' => $this->faker->randomFloat(2, 2000, 10000),
        ]);
    }

    /**
     * State for compact devices
     */
    public function compact(): static
    {
        return $this->state(fn (array $attributes) => [
            'height' => $this->faker->numberBetween(200, 600),
            'width' => $this->faker->numberBetween(200, 500),
            'depth' => $this->faker->numberBetween(150, 400),
            'weight' => $this->faker->randomFloat(2, 5, 50),
        ]);
    }
}
