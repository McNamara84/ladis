<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
            'sample_surface_id'         =>  1,
            'foundation_material_id'    =>  2,
            'coating_material_id'       =>  3,
            'condition_id'              =>  4,
            'result_id'                 =>  5,
            'size'                      =>  1.00,
        ];
    }
}
