<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Image;
use App\Models\Condition;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Image>
 */
class ImageFactory extends Factory
{
    protected $model = Image::class;

    public function definition(): array
    {
        return [
            'condition_id' => Condition::factory(),
            'project_id' => Project::factory(),
            'uri' => $this->faker->unique()->slug().'.jpg',
            'description' => $this->faker->optional()->sentence(),
            'alt_text' => $this->faker->words(3, true),
            'year_created' => $this->faker->year(),
            'creator' => $this->faker->name(),
        ];
    }
}
