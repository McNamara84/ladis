<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Lens extends Model
{
    use HasFactory;
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
