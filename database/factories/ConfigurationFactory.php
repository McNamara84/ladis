<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Configuration>
 */
class ConfigurationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'lens_id'           =>  1,
            'focal_length'      =>  100,
            'output'            =>  1000.00,
            'pw'                =>  1000,
            'pf'                =>  100,
            'scan_width'        =>  10.0,
            'scan_frequency'    =>  10,
            'spot_size'         =>  100.0,
            'fluence'           =>  10.000,
            'description'       =>  Str::random(20),
        ];
    }
}
