<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Location;

/**
 * Venue Model
 *
 * - Belongs to a City (n:1)
 * - Has many Locations (1:n)
 */
class Venue extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'venues';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    // protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'city_id',
        'name',
    ];

    /**
     * Attribute casting for stronger type safety.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'city_id' => 'integer',
        'name' => 'string',
    ];

    /**
     * n:1 relationship to City (Venue belongs to City).
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    /**
     * 1:n relationship to Location (Venue has many Locations).
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }
}
