<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Condition;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Image;
use App\Models\Project;
use App\Models\Person;
use App\Models\Venue;
use App\Models\SampleSurface;
use App\Models\PartialSurface;
use App\Models\Material;
use App\Models\Artifact;

class ConditionTest extends TestCase
{
    use RefreshDatabase;

    public function test_fillable_attributes_are_defined(): void
    {
        $condition = new Condition();

        $this->assertSame([
            'damage_pattern_id',
            'wac',
            'description',
            'lab_l',
            'lab_a',
            'lab_b',
            'severity',
            'adhesion',
        ], $condition->getFillable());
    }

    public function test_casts_for_attributes_are_applied(): void
    {
        $condition = new Condition([
            'wac' => '1.25',
            'lab_l' => 50.678,
            'lab_a' => '5.4321',
            'lab_b' => 3,
        ]);

        $this->assertIsFloat($condition->wac);
        $this->assertSame(1.25, $condition->wac);
        $this->assertSame('50.68', $condition->lab_l);
        $this->assertSame('5.43', $condition->lab_a);
        $this->assertSame('3.00', $condition->lab_b);
    }

    public function test_damage_pattern_relationship_is_belongsto(): void
    {
        $condition = new Condition();
        $relation = $condition->damagePattern();

        $this->assertInstanceOf(BelongsTo::class, $relation);
        $this->assertInstanceOf(DamagePattern::class, $relation->getRelated());
        $this->assertSame('damage_pattern_id', $relation->getForeignKeyName());
    }

    public function test_damage_pattern_relation_returns_associated_model(): void
    {
        $pattern = DamagePattern::create(['name' => 'Scratch']);
        $condition = Condition::create([
            'damage_pattern_id' => $pattern->id,
            'severity' => 'leicht beschädigt',
            'adhesion' => 'mäßig',
        ]);

        $this->assertTrue($condition->damagePattern->is($pattern));
        $this->assertIsString($condition->severity);
        $this->assertIsString($condition->adhesion);
        $this->assertSame('leicht beschädigt', $condition->severity);
        $this->assertSame('mäßig', $condition->adhesion);
    }

    public function test_images_relationship_and_accessors(): void
    {
        $condition = Condition::create([
            'damage_pattern_id' => DamagePattern::factory()->create()->id,
        ]);
        $project = Project::forceCreate([
            'name' => 'P',
            'description' => 'd',
            'url' => 'http://e.com',
            'started_at' => '2024-01-01',
            'ended_at' => '2024-01-02',
            'person_id' => Person::factory()->create()->id,
            'venue_id' => Venue::factory()->create()->id,
        ]);

        $img = Image::forceCreate([
            'condition_id' => $condition->id,
            'project_id' => $project->id,
            'uri' => 'a',
            'description' => 'd',
            'alt_text' => 'a',
            'year_created' => 2024,
            'creator' => 'me',
        ]);

        $relation = $condition->images();
        $this->assertInstanceOf(HasMany::class, $relation);
        $this->assertTrue($condition->images->contains($img));
    }

    public function test_condition_of_and_result_of_relationships(): void
    {
        $condition = Condition::create([
            'damage_pattern_id' => DamagePattern::factory()->create()->id,
        ]);
        $other = Condition::create([
            'damage_pattern_id' => DamagePattern::factory()->create()->id,
        ]);
        $sample = SampleSurface::forceCreate([
            'name' => 'S',
            'description' => 'd',
            'artifacts_id' => Artifact::factory()->create()->id,
        ]);
        $pre = PartialSurface::create([
            'sample_surface_id' => $sample->id,
            'foundation_material_id' => Material::create(['name' => 'f'])->id,
            'coating_material_id' => Material::create(['name' => 'c'])->id,
            'condition_id' => $condition->id,
            'result_id' => $other->id,
            'size' => 1.0,
        ]);

        $this->assertInstanceOf(HasOne::class, $condition->conditionOf());
        $this->assertInstanceOf(HasOne::class, $other->resultOf());
        $this->assertTrue($condition->conditionOf->is($pre));
        $this->assertTrue($other->resultOf->is($pre));
    }
}
