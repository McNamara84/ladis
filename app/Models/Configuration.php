<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Process;
use App\Models\Lens;
use Illuminate\Support\Carbon;

/**
 * Configuration Model:
 * 
 * - has many processes (1:n)
 * - has a lens (n:1)
 * 
 * A lens can be used with multiple configurations,
 * a configuration can be used with only one lens.
 * 
 * @property int $id
 * @property int $lens_id
 * @property int $focal_length
 * @property float $output
 * @property int $pw
 * @property int $pf
 * @property int $scan_frequency
 * @property string $scan_width
 * @property string $spot_size
 * @property string $fluence
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */

class Configuration extends Model
{
    use HasFactory;
    
    protected $casts = [
        'lens_id'           =>  'integer',
        'focal_length'      =>  'integer',
        'output'            =>  'float',
        'pw'                =>  'integer',
        'pf'                =>  'integer',
        'scan_width'        =>  'decimal:1',
        'scan_frequency'    =>  'integer',
        'spot_size'         =>  'decimal:1',
        'fluence'           =>  'decimal:3',
        'description'       =>  'string',
    ];
    
    protected $guarded = ['id', 'created_at', 'updated_at'];
    
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
