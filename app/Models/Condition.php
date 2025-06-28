<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\DamagePattern;
use App\Models\Image;
use App\Models\PartialSurface;

/**
 * Condition Model:
 *
 * - belongs to DamagePattern (n:1)
 * - has many Images (1:n)
 * - has one PartialSurface (1:1)
 */
class Condition extends Model
{
    use HasFactory;
    protected $table = 'conditions';

    protected $fillable = [
        'damage_pattern_id',
        'wac',
        'description',
        'lab_l',
        'lab_a',
        'lab_b',
        'severity',
        'adhesion',
    ];
    // LAB color values with only two decimal places allowed
    protected $casts = [
        'wac' => 'float',
        'lab_l' => 'decimal:2',
        'lab_a' => 'decimal:2',
        'lab_b' => 'decimal:2',

    ];

    /**
     * n:1 relationship to DamagePattern (backwards)
     */
    public function damagePattern(): BelongsTo
    {
        return $this->belongsTo(DamagePattern::class);
    }

    /**
     * 1:n relationship to Image
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * 1:1 relationship to PartialSurface (being a pre-condition)
     */
    public function conditionOf(): HasOne
    {
        return $this->hasOne(PartialSurface::class, 'condition_id');
    }

    /**
     * 1:1 relationship to PartialSurface (being a result)
     */
    public function resultOf(): HasOne
    {
        return $this->hasOne(PartialSurface::class, 'result_id');
    }
}
