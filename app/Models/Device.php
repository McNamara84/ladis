<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Institution;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\Lens;
use App\Models\User;

/**
 * Device Model
 *
 * - Belongs to an institution (n:1)
 * - Has many lenses (n:m)
 */
class Device extends Model
{
    use HasFactory;

    /**
     * Attribute casting for stronger type safety
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

    // TODO: Add methods hasBeamType() and hasBuildType() if we will need this for validations and dropdowns

    /**
     * 1:n relationship to Institution (backwards)
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
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
}
