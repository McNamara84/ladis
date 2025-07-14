<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Device;
use App\Models\Institution;
use App\Models\User;
use App\Models\Lens;
use App\Models\Artifact;
use App\Models\SampleSurface;
use App\Models\PartialSurface;
use App\Models\Configuration;
use App\Models\Material;
use App\Models\Process;
use App\Models\Condition;
use App\Models\DamagePattern;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;


class DeviceTest extends TestCase
{
    use RefreshDatabase;

    public function test_casts_and_human_readable_attributes(): void
    {
        $device = new Device([
            'build' => Device::BUILD_FIBER,
            'beam_type' => Device::BEAM_LINE,
            'cooling' => Device::COOLING_EXTERNAL,
            'height' => '10',
            'max_output' => '15.5'
        ]);

        $this->assertEquals('Glasfaser', $device->build_type);
        $this->assertEquals('Zeilenlaser', $device->beam_type_name);
        $this->assertEquals('Extern', $device->cooling_type);
        $this->assertIsInt($device->height);
        $this->assertIsFloat($device->max_output);
    }

    public function test_relationships(): void
    {
        $institution = Institution::factory()->create();
        $user = User::factory()->create();
        $device = Device::factory()->for($institution)->for($user, 'lastEditor')->create();
        $lens = Lens::factory()->create();
        $device->lenses()->attach($lens);
        $sample = SampleSurface::factory()->create();
        $partialSurface = PartialSurface::create([
            'sample_surface_id' => $sample->id,
            'foundation_material_id' => Material::create(['name' => 'm'])->id,
            'coating_material_id' => Material::create(['name' => 'c'])->id,
            'condition_id' => Condition::factory()->state(['severity' => 'a'])->create()->id,
            'result_id' => Condition::factory()->state(['severity' => 'b'])->create()->id,
            'size' => 1.0,
        ]);
        $config = Configuration::create([
            'lens_id' => $lens->id,
            'focal_length' => 100,
            'output' => 100,
            'pw' => 10,
            'pf' => 10,
            'scan_width' => 1.0,
            'scan_frequency' => 1,
            'spot_size' => 1.0,
            'fluence' => 1.0,
        ]);
        $process = Process::create([
            'partial_surface_id' => $partialSurface->id,
            'device_id' => $device->id,
            'configuration_id' => $config->id,
            'description' => 'proc',
            'duration' => 0,
            'wet' => 0,
        ]);

        $this->assertInstanceOf(BelongsTo::class, $device->institution());
        $this->assertInstanceOf(BelongsToMany::class, $device->lenses());
        $this->assertInstanceOf(HasMany::class, $device->processes());
        $this->assertInstanceOf(BelongsTo::class, $device->lastEditor());
        $this->assertTrue($device->lenses->contains($lens));
        $this->assertTrue($device->processes->contains($process));
        $this->assertTrue($device->lastEditor->is($user));
    }

    public function test_human_readable_attributes_cover_all_cases(): void
    {
        $device = new Device();
        $device->build = Device::BUILD_MIRROR_ARM;
        $device->beam_type = Device::BEAM_POINT;
        $device->cooling = Device::COOLING_INTERNAL;
        $this->assertEquals('Spiegelarm', $device->build_type);
        $this->assertEquals('Punktlaser', $device->beam_type_name);
        $this->assertEquals('Intern', $device->cooling_type);

        $device->build = 99;
        $device->beam_type = 99;
        $device->cooling = 99;
        $this->assertEquals('Unbekannt', $device->build_type);
        $this->assertEquals('Unbekannt', $device->beam_type_name);
        $this->assertEquals('Unbekannt', $device->cooling_type);
    }
}
