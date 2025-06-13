<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\DamagePattern;

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
    protected $casts = [
        'wac'=>'float', 
        // only two decimal places are allowed
        'lab_l'=>'decimal:2', 
        'lab_a'=>'decimal:2', 
        'lab_b'=>'decimal:2', 

];
public function damagePattern(): BelongsTo
{
    return $this->belongsTo(DamagePattern::class);
}
}
