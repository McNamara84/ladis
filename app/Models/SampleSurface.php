<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Artifact;
use App\Models\PartialSurface;
use Illuminate\Support\Carbon;

/**
 * SampleSurface Model:
 * 
 * - belongs to Artifact (n:1)
 * - has many PartialSurfaces (1:n)
 * 
 * @property int $id
 * @property int $artifacts_id
 * @property string $name
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class SampleSurface extends Model
{

    use HasFactory;

    protected $fillable = [
        'artifacts_id',
        'name',
        'description',
    ];

    protected $casts = [
        'artifacts_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
    ];

    /**
     * n:1 relationship to Artifact
     */
    public function artifact(): BelongsTo
    {
        return $this->belongsTo(Artifact::class, 'artifacts_id');
    }

    /**
     * 1:n relationship to PartialSurface
     */
    public function partialSurfaces(): HasMany
    {
        return $this->hasMany(PartialSurface::class);
    }
}
