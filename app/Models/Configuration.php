<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Process;
use App\Models\Lens;

/**
 * Configuration Model:
 * 
 * - belongs to many processes (1:n)
 * - has a lens (n:1)
 * 
 * A lens can be used with multiple configurations,
 * a configuration can be used with only one lens.
 */

class configuration extends Model
{
    use HasFactory;
    
    protected $table = 'configurations';

    protected $casts = [
        'lens_id'           =>  'unsignedInteger',
        'focal_length'      =>  'unsignedInteger',
        'output'            =>  'float',
        'pw'                =>  'unsignedInteger',
        'pf'                =>  'unsignedInteger',
        'scan_width'        =>  'float',
        'scan_frequency'    =>  'unsignedInteger',
        'spot_size'         =>  'float',
        'fluence'           =>  'float',
        'description'       =>  'string',
    ];
    
    protected $guarded = ['id'];
    
    /**
     * 1:n relationship to Process
     */
    public function processes(): BelongsToMany
    {
        return $this->belongsToMany(Process::class);
    }

    /**
     * n:1 relationship to Lens (backwards)
     */
    public function lens(): BelongsTo
    {
        return $this->belongsTo(Lens::class);
    }
}
