<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\SampleSurface;
use App\Models\Process;
use App\Models\Condition;
use App\Models\Material;

/**
 * PartialSurface Model:
 * 
 * - belongs to SampleSurface (n:1)
 * - has one Process (1:1)
 * - has one (pre-)Condition (1:1)
 * - has one (result) Condition (1:1)
 * - belongs to (foundation) Material (n:1)
 * - belongs to (coating) Material (n:1)
 */
class PartialSurface extends Model
{
    use HasFactory;

    protected $casts = [
        'sample_surface_id'         =>  'integer',
        'foundation_material_id'    =>  'integer',
        'coating_material_id'       =>  'integer',
        'condition_id'              =>  'integer',
        'result_id'                 =>  'integer',
        'identifier'                =>  'string',
        'size'                      =>  'decimal:2',
    ];

    protected $guarded = ['id', 'created_at', 'updated_at'];

    /**
     * n:1 relationship to SampleSurface (backwards)
     */
    public function sampleSurface(): BelongsTo
    {
       return $this->belongsTo(SampleSurface::class);
    }

    /**
     * 1:1 relationship to Process
     */
    public function process(): HasOne
    {
        return $this->hasOne(Process::class);
    }

    /**
     * 1:1 relationship to Condition as the pre-condition
     */
    public function condition(): BelongsTo
    {
      return $this->belongsTo(Condition::class, 'condition_id');
    }
    
     /**
     * 1:1 relationship to Condition as the result
     */
    public function result(): BelongsTo
    {
       return $this->belongsTo(Condition::class, 'result_id');
    }
    
    /**
     * n:1 relationship to Material as the foundation material (backwards)
     */
    public function foundationMaterial(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'foundation_material_id');
    }

    /**
     * n:1 relationship to Material as the coating material (backwards)
     */
    public function coatingMaterial(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'coating_material_id');
    }
}
