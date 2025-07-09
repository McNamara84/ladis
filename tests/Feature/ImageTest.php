<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Image;
use App\Models\Condition;
use App\Models\Project;
use App\Models\Person;
use App\Models\Venue;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class ImageTest extends TestCase
{
    use RefreshDatabase;

    public function test_casts_for_attributes_are_defined(): void
    {
        $image = new Image([
            'project_id' => '1',
            'condition_id' => '2',
            'year_created' => '1999',
        ]);

        $this->assertIsInt($image->project_id);
        $this->assertIsInt($image->condition_id);
        $this->assertIsInt($image->year_created);
    }

    public function test_relationships_return_correct_types(): void
    {
        $condition = Condition::create([
            'severity' => 'leicht',
            'adhesion' => 'gut',
            'damage_pattern_id' => DamagePattern::factory()->create()->id,
        ]);
        $project = Project::forceCreate([
            'name' => 'P',
            'description' => 'desc',
            'url' => 'http://example.com',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => Person::factory()->create()->id,
            'venue_id' => Venue::factory()->create()->id,
        ]);
        $image = Image::create([
            'condition_id' => $condition->id,
            'project_id' => $project->id,
            'uri' => 'img.jpg',
            'alt_text' => 'alt',
            'year_created' => 2020,
            'creator' => 'c',
        ]);

        $this->assertInstanceOf(BelongsTo::class, $image->condition());
        $this->assertInstanceOf(BelongsTo::class, $image->project());
        $this->assertInstanceOf(HasOne::class, $image->coverOf());
        $this->assertInstanceOf(HasOne::class, $image->thumbnailOf());
    }
}
