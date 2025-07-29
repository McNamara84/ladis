<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Project;
use App\Models\Image;
use App\Models\Condition;
use App\Models\Person;
use App\Models\Venue;
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
            'person_id',
            'venue_id',
        ], $project->getFillable());
        $this->assertInstanceOf(\Carbon\Carbon::class, $project->started_at);
        $this->assertInstanceOf(\Carbon\Carbon::class, $project->ended_at);
    }

    public function test_relationships(): void
    {
        $project = Project::factory()->create();
        $image = Image::factory()
            ->for(Condition::factory()->state([
                'severity' => 'x',
                'adhesion' => 'y',
            ]))
            ->for($project)
            ->state([
                'uri' => 'img',
                'alt_text' => 'alt',
                'year_created' => 2020,
                'creator' => 'c',
            ])->create();
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

    public function test_database_enforces_unique_name_constraint(): void
    {
        $name = 'Laser Projekt';
        Project::factory()->create(['name' => $name]);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Project::factory()->create(['name' => $name]);
    }

    public function test_database_enforces_unique_url_constraint(): void
    {
        $url = 'https://ladis.test';
        Project::factory()->create(['url' => $url]);

        $this->expectException(\Illuminate\Database\QueryException::class);
        Project::factory()->create(['url' => $url]);
    }

    public function test_person_id_is_required(): void
    {
        $venue = Venue::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);
        Project::create([
            'name' => 'Proj',
            'description' => 'desc',
            'url' => 'https://p.test',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'venue_id' => $venue->id,
        ]);
    }

    public function test_venue_id_is_required(): void
    {
        $person = Person::factory()->create();

        $this->expectException(\Illuminate\Database\QueryException::class);
        Project::create([
            'name' => 'Proj',
            'description' => 'desc',
            'url' => 'https://p.test',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => $person->id,
        ]);
    }
}
