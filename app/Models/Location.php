<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Venue;

/**
 * Location Model
 *
 * - Belongs to a Venue (n:1)
 */
class Location extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // protected $table = 'locations';

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
        'name',
        'venue_id',
    ];

    /**
     * Attribute casting for stronger type safety.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'name' => 'string',
        'venue_id' => 'integer',
    ];

    /**
     * n:1 relationship to Venue (Location belongs to Venue).
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
