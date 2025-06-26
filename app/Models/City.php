<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\FederalState;
use App\Models\Venue;

/**
 * City Model:
 *
 * - belongs to FederalState (n:1)
 * - has many Venues (1:n)
 */
class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'federal_state_id',
        'name',
        'postal_code',
    ];

    /**
     * Casts secure correct data types for attributes.
     * Here it is important to cast postal_code as a string if numbers would be send from the input form.
     * 
     */
    protected $casts = [
        'postal_code' => 'string',
    ];

    /**
     * BelongsTo relation to FederalState
     * 
     * One City belongs to one FederalState.
     * Inverse of FederalState::cities()
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function federalState(): BelongsTo
    {
        return $this->belongsTo(FederalState::class);
    }

    /**
     * HasMany relation to Venue
     * 
     * One City has many Venues.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function venues(): HasMany
    {
        return $this->hasMany(Venue::class);
    }

    /**
     * Accessor for the full name including the federal state
     *
     * Usage: $city->full_name
     * Output: "Potsdam, Brandenburg"
     *
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        // Avoid eager loading with relationLoaded()
        if ($this->relationLoaded('federalState')) {
            return "{$this->name}, {$this->federalState->name}";
        }

        // If the relationship isn't specified, return only the city name
        return $this->name;
    }
}
