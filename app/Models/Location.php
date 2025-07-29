<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Artifact;
use App\Models\Venue;
use Illuminate\Support\Carbon;

/**
 * Location Model
 *
 * - Belongs to a Venue (n:1)
 * - Has many Artifacts (1:n)
 * 
 * @property int $id
 * @property int $venue_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Location extends Model
{
    use HasFactory;

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
        'venue_id',
        'name',
    ];

    /**
     * Attribute casting for stronger type safety.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'venue_id' => 'integer',
        'name' => 'string',
    ];

    /**
     * n:1 relationship to Venue (Location belongs to Venue).
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }

    /**
     * 1:n relationship to Artifact (Location has many Artifacts).
     */
    public function artifacts(): HasMany
    {
        return $this->hasMany(Artifact::class);
    }
}
