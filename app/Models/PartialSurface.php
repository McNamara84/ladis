<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\SampleSurface;
use App\Models\Process;
use App\Models\Condition;
use App\Models\Material;

/**
 * PartialSurface Model:
 * 
 * - belongs to a sample_surface (n:1)
 * - belongs to a process (1:1)
 * - has a (pre-)condition (1:1)
 * - has a (result) condition (1:1)
 * - has a (foundation) material (1:1)
 * - has a (coating) material (1:1)
 */

class PartialSurface extends Model
{
    use HasFactory;

    protected $table = 'partial_surfaces';

    protected $casts = [
        'sample_surface_id'         =>  'unsignedInteger',
        'foundation_material_id'    =>  'unsignedInteger',
        'coating_material_id'       =>  'unsignedInteger',
        'condition_id'              =>  'unsignedInteger',
        'result_id'                 =>  'unsignedInteger',
        'description'               =>  'string',
        'size'                      =>  'decimal:2',
    ];

    protected $guarded = ['id'];

    /**
     * n:1 relationship to SampleSurface (backwards)
     */
    public function sample_surface(): BelongsTo
    {
        return $this->belongsTo(SampleSurface::class);
    }

    /**
     * 1:1 relationship to Process
     */
    public function process(): BelongsTo
    {
        return $this->belongsTo(Process::class);
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
     * 1:1 relationship to Material as the foundation material
     */
    public function foundation_material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'foundation_material_id');
    }

    /**
     * 1:1 relationship to Material as the coating material
     */
    public function coating_material(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'coating_material_id');
    }
}
