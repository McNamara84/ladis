<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Institution;
use App\Models\Project;

/**
 * Person Model:
 *
 * - represents a person entity in the system
 * - belongs to an Institution (n:1)
 * - has many Projects (1:n)
 */
class Person extends Model
{
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
