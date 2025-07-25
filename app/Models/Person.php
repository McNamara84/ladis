<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Institution;
use App\Models\Project;
use Illuminate\Support\Carbon;

/**
 * Person Model:
 *
 * - represents a person entity in the system
 * - belongs to an Institution (n:1)
 * - has many Projects (1:n)
 * 
 * @property int $id
 * @property int $institution_id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Person extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * Must be explicitly defined to prevent Eloquent from using 'people'
     * instead of the actual 'persons' table name.
     *
     * @var string
     */
    protected $table = 'persons';

    /**
     * The attributes that are not mass assignable.
     *
     * Protects the 'id' field from mass assignment for security.
     *
     * @var list<string>
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'institution_id' => 'integer',
        'name' => 'string',
    ];

    /**
     * n:1 relation to Institution: a Person belongs to one Institution
     *
     * @return BelongsTo
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * 1:n relation to Project: a Person can have many Projects
     *
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
