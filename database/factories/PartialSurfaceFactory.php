<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Material;
use App\Models\Condition;
use App\Models\SampleSurface;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PartialSurface>
 */
class PartialSurfaceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'sample_surface_id'         => SampleSurface::factory(),
            'foundation_material_id'    => Material::factory(),
            'coating_material_id'       => Material::factory(),
            'condition_id'              => Condition::factory(),
            'result_id'                 => Condition::factory(),
            'identifier'                =>  Str::random(10),
            'size'                      =>  1.00,
        ];
    }
}
