<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\PartialSurface;
use App\Models\Device;
use App\Models\Configuration;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Process>
 */
class ProcessFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'partial_surface_id'    => PartialSurface::factory(),
            'device_id'             => Device::factory(),
            'configuration_id'      => Configuration::factory(),
            'description'           =>  Str::random(20),
            'duration'              =>  fake()->randomElement([0, 1, 2, 3]),
            'wet'                   =>  fake()->randomElement([0, 1]),
        ];
    }
}
