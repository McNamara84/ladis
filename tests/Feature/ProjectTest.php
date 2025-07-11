<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Image;
use App\Models\Condition;
use App\Models\Person;
use App\Models\Venue;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_and_casts_are_defined(): void
    {
        $project = new Project([
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
        ]);

        $this->assertSame([
            'name',
            'description',
            'url',
            'started_at',
            'ended_at',
        ], $project->getFillable());
        $this->assertInstanceOf(\Carbon\Carbon::class, $project->started_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $project->ended_at);
    }

    public function test_relationships(): void
    {
        $person = Person::factory()->create();
        $venue = Venue::factory()->create();
        $project = Project::forceCreate([
            'name' => 'Project',
            'description' => 'desc',
            'url' => 'http://example.com',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => $person->id,
            'venue_id' => $venue->id,
        ]);
        $image = Image::create([
            'condition_id' => Condition::create([
                'severity' => 'x',
                'adhesion' => 'y',
                'damage_pattern_id' => DamagePattern::factory()->create()->id,
            ])->id,
            'project_id' => $project->id,
            'uri' => 'img',
            'alt_text' => 'alt',
            'year_created' => 2020,
            'creator' => 'c',
        ]);
        $project->coverImage()->associate($image);
        $project->thumbnailImage()->associate($image);
        $project->save();

        $this->assertInstanceOf(HasMany::class, $project->images());
        $this->assertInstanceOf(BelongsTo::class, $project->coverImage());
        $this->assertInstanceOf(BelongsTo::class, $project->thumbnailImage());
        $this->assertInstanceOf(BelongsTo::class, $project->person());
        $this->assertInstanceOf(BelongsTo::class, $project->venue());
        $this->assertTrue($project->images->contains($image));
        $this->assertTrue($project->coverImage->is($image));
        $this->assertTrue($project->thumbnailImage->is($image));
    }
}
