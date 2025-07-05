<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Condition;

/**
 * DamagePattern Model:
 *
 * - has many Conditions (1:n)
 */
class DamagePattern extends Model
{
    use HasFactory;
    protected $table = 'damage_patterns';

    protected $fillable = [
        'name',
    ];
    
    /**
    * 1:n relationship to Condition
    */
    public function conditions(): HasMany
{
    return $this->hasMany(Condition::class);
}

}
