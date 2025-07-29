<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\City;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class FederalState extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * HasMany relation to Cities
     * 
     * One federal state can have many cities.
     * Laravel is searching 'federal_state_id' in table cities
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities(): HasMany
    {
        // Short if naming convention is followed
        return $this->hasMany(City::class);
    }
}
