<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Location;

/**
 * Artifact Model
 *
 * - Belongs to a Location (n:1)
 */
class Artifact extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'location_id',
        'inventory_number'
    ];

    /**
     * Attribute casting for stronger type safety.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'name' => 'string',
        'location_id' => 'integer',
        'inventory_number' => 'string',
    ];

    /**
     * n:1 relationship to Location (Artifact belongs to Location).
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }
}
