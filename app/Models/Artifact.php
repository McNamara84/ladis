<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\SampleSurface;
use App\Models\Location;
use Illuminate\Support\Carbon;

/**
 * Artifact Model:
 *
 * - belongs to Location (n:1)
 * - has many SampleSurfaces (1:n)
 * 
 * @property int $id
 * @property int $location_id
 * @property string $name
 * @property string|null $inventory_number
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Artifact extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * Laravel would automatically assume 'artifacts' (plural of Artifact).
     * An explicit definition is optional in this case but makes the code more readable.
     *
     * @var string
     */
    protected $table = 'artifacts';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'location_id',
        'name',
        'inventory_number'
    ];

    /**
     * Attribute casting for stronger type safety.
     *
     * @var array<string, mixed>
     */
    protected $casts = [
        'location_id' => 'integer',
        'name' => 'string',
        'inventory_number' => 'string',
    ];

    /**
     * n:1 relationship to Location (backwards)
     */
    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    /**
     * 1:n relationship to SampleSurface
     */
    public function sampleSurfaces(): HasMany
    {
        return $this->hasMany(SampleSurface::class, 'artifacts_id');
    }
}
