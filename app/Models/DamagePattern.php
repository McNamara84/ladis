<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Condition;

class DamagePattern extends Model
{
    use HasFactory;
    protected $table = 'damage_patterns';

    protected $fillable = [
        'name',
    ];
    public function conditions(): HasMany
{
    return $this->hasMany(Condition::class);
}

}
