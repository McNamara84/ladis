<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Process;
use App\Models\Lens;

/**
 * Configuration Model:
 * 
 * - has many processes (1:n)
 * - has a lens (n:1)
 * 
 * A lens can be used with multiple configurations,
 * a configuration can be used with only one lens.
 */

class Configuration extends Model
{
    use HasFactory;
    
    protected $casts = [
        'lens_id'           =>  'integer',
        'focal_length'      =>  'float',
        'output'            =>  'float',
        'pw'                =>  'float',
        'pf'                =>  'float',
        'scan_width'        =>  'float',
        'scan_frequency'    =>  'float',
        'spot_size'         =>  'float',
        'fluence'           =>  'float',
        'description'       =>  'text',
    ];
    
    protected $guarded = ['id'];
    
    /**
     * 1:n relationship to Process
     */
    public function processes(): HasMany
    {
        return $this->hasMany(Process::class);
    }

    /**
     * n:1 relationship to Lens (backwards)
     */
    public function lens(): BelongsTo
    {
        return $this->belongsTo(Lens::class);
    }
}
