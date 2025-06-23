<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\hasOne;
use App\Models\Configuration;
use App\Models\PartialSurface;
use App\Models\Device;

/**
 * Process Model:
 * 
 * - belongs to Device (n:1)
 * - belongs to Configuration (n:1)
 * - has one PartialSurface (1:1)
 */

class Process extends Model
{
    use HasFactory;

    protected $casts = [
        'partial_surface_id'    =>  'integer',
        'device_id'             =>  'integer',
        'configuration_id'      =>  'integer',
        'description'           =>  'string',
        'duration'              =>  'integer',
        'wet'                   =>  'integer',
    ];

   protected $guarded = ['id', 'created_at', 'updated_at'];

    //possible values for the duration attribute
    const DURATION_0    =   0;
    const DURATION_1    =   1;
    const DURATION_2    =   2;
    const DURATION_3    =   3;

    //possible values for the wet (wetness) attribute
    const WET_DRY   =   0;
    const WET_WET   =   1;

    //all possible durations as an array
    public static function getDurations(): array
    {
        return [
            self::DURATION_0,
            self::DURATION_1,
            self::DURATION_2,
            self::DURATION_3,
        ];
    }

    //all possible wetness types as an array
    public static function getWetTypes(): array
    {
        return [
            self::WET_DRY,
            self::WET_WET,
        ];
    }

    /**
     * n:1 relationship to Device (backwards)
     */
    public function device(): BelongsTo
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * n:1 relationship to Configuration (backwards)
     */
    public function configuration(): BelongsTo
    {
        return $this->belongsTo(Configuration::class);
    }

    /**
     * 1:1 relationship to PartialSurface
     */
    public function partialSurface(): HasOne
    {
        return $this->hasOne(PartialSurface::class);
    }
}
