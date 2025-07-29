<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Configuration;
use App\Models\Device;
use Illuminate\Support\Carbon;

/**
 * Lens Model:
 *
 * - has many Configurations (1:n)
 * - belongs to many Devices (m:n)
 * 
 * @property int $id
 * @property int $size
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Lens extends Model
{
    use HasFactory;

    protected $fillable = ['size'];

    protected $casts = [
        'size' => 'integer',
    ];

    /**
     * HasMany relationship to configurations
     *
     * A lens can be used in many configurations,
     * and a configuration can have one lens.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function configurations(): HasMany
    {
        return $this->hasMany(Configuration::class);
    }

    /**
     * BelongsToMany relationship to devices
     *
     * A lens can be used in many devices,
     * and a device can have many lenses.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function devices(): BelongsToMany
    {
        // Simplest form – Laravel automatically detects the pivot table.
        // Expected: 'device_lens' (alphabetical, singular)
        return $this->belongsToMany(Device::class);

        // Explicit form with all parameters would be:
        // return $this->belongsToMany(
        //     Device::class,    // Related model
        //     'device_lens',    // Pivot table name
        //     'lens_id',        // Foreign key of this model
        //     'device_id'       // Foreign key of the related model
        // );
    }
}
