<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Institution;

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
    ];

    /**
     * 1:n relationship to Institution (backwards)
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
