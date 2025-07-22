<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\City;
use App\Models\Location;
use App\Models\Project;
use Illuminate\Support\Carbon;

/**
 * Venue Model:
 *
 * - belongs to City (n:1)
 * - has many Locations (1:n)
 * - has many Projects (1:n)
 *
 * @property int $id
 * @property int $city_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Venue extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'venues';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
     * n:1 relationship to City (backwards)
     */
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    
    /**
     * 1:n relationship to Location
     */
    public function locations(): HasMany
    {
        return $this->hasMany(Location::class);
    }

    /**
     * 1:n relationship to Project
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
