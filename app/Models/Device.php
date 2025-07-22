<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Institution;
use App\Models\Lens;
use App\Models\Process;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * Device Model
 *
 * - belongs to Institution (n:1)
 * - has many Processes (1:n)
 * - belongs to many Lenses (n:m)
 * 
 * @property int $id
 * @property int $institution_id
 * @property string $name
 * @property string|null $description
 * @property int|null $year
 * @property int|null $build
 * @property int|null $safety_class
 * @property int|null $height
 * @property int|null $width
 * @property int|null $depth
 * @property string|null $weight
 * @property string|null $fiber_length
 * @property int|null $cooling
 * @property bool|null $mounting
 * @property bool|null $automation
 * @property float|null $max_output
 * @property float|null $mean_output
 * @property float|null $max_wattage
 * @property string|null $head
 * @property int|null $emission_source
 * @property int $beam_type
 * @property string|null $beam_profile
 * @property float|null $wavelength
 * @property float|null $min_spot_size
 * @property float|null $max_spot_size
 * @property float|null $min_pf
 * @property float|null $max_pf
 * @property float|null $min_pw
 * @property float|null $max_pw
 * @property float|null $min_scan_width
 * @property float|null $max_scan_width
 * @property float|null $min_focal_length
 * @property float|null $max_focal_length
 * @property int|null $last_edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Device extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'institution_id',
        'name',
        'description', 
        'year',
        'build',
        'safety_class',
        'height',
        'width', 
        'depth',
        'weight',
        'fiber_length',
        'cooling',
        'mounting',
        'automation',
        'max_output',
        'mean_output',
        'max_wattage',
        'head',
        'emission_source',
        'beam_type',
        'beam_profile',
        'wavelength',
        'min_spot_size',
        'max_spot_size',
        'min_pf',
        'max_pf',
        'min_pw',
        'max_pw',
        'min_scan_width',
        'max_scan_width',
        'min_focal_length',
        'max_focal_length',
        'last_edit_by',
    ];

    /**
     * The attributes that should be cast.
     */
    protected $casts = [
        'institution_id'  => 'integer',
        'year'            => 'integer',
        'build'           => 'integer',
        'safety_class'    => 'integer',
        'height'          => 'integer',
        'width'           => 'integer',
        'depth'           => 'integer',
        'weight'          => 'decimal:2',
        'fiber_length'    => 'decimal:2',
        'cooling'         => 'integer',
        'mounting'        => 'boolean',
        'automation'      => 'boolean',
        'beam_type'       => 'integer',
        'emission_source' => 'integer',
        'max_output'      => 'float',
        'mean_output'     => 'float',
        'max_wattage'     => 'float',
        'wavelength'      => 'float',
        'min_spot_size'   => 'float',
        'max_spot_size'   => 'float',
        'min_pf'          => 'float',
        'max_pf'          => 'float',
        'min_pw'          => 'float',
        'max_pw'          => 'float',
        'min_scan_width'  => 'float',
        'max_scan_width'  => 'float',
        'min_focal_length'=> 'float',
        'max_focal_length'=> 'float',
        'last_edit_by'    => 'integer',
    ];

    /**
     * Constants for build types
     */
    const BUILD_FIBER = 0;
    const BUILD_MIRROR_ARM = 1;

    /**
     * Constants for beam types
     */
    const BEAM_POINT = 0;
    const BEAM_LINE  = 1;
    const BEAM_AREA  = 2;

    /**
     * Constants for cooling types
     */
    const COOLING_INTERNAL = 0;
    const COOLING_EXTERNAL = 1;

    // TODO: Add methods hasBeamType() and hasBuildType() if we will need this for validations and dropdowns

    /**
     * n:1 relationship to Institution (backwards)
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * 1:n relationship to Process
     */
    public function processes(): HasMany
    {
        return $this->hasMany(Process::class);
    }

    /**
     * n:m relationship to Lenses
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lenses(): BelongsToMany
    {
        return $this->belongsToMany(Lens::class)->withTimestamps(); // n:m with timestamps
    }

    /**
     * n:1 relationship to User who last edited the device
     */
    public function lastEditor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'last_edit_by');
    }

    /**
     * Get human readable build type
     */
    public function getBuildTypeAttribute(): string
    {
        return match($this->build) {
            self::BUILD_FIBER => 'Glasfaser',
            self::BUILD_MIRROR_ARM => 'Spiegelarm',
            default => 'Unbekannt'
        };
    }

    /**
     * Get human readable beam type
     */
    public function getBeamTypeNameAttribute(): string
    {
        return match($this->beam_type) {
            self::BEAM_POINT => 'Punktlaser',
            self::BEAM_LINE => 'Zeilenlaser', 
            self::BEAM_AREA => 'Flächenlaser',
            default => 'Unbekannt'
        };
    }

    /**
     * Get human readable cooling type
     */
    public function getCoolingTypeAttribute(): string
    {
        return match($this->cooling) {
            self::COOLING_INTERNAL => 'Intern',
            self::COOLING_EXTERNAL => 'Extern',
            default => 'Unbekannt'
        };
    }
}
