<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Person Model
 *
 * Represents a person entity in the system.
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'person_id' => 'integer',
        'name' => 'string',
    ];

    /**
     * n:1 relation: A Person belongs to one Institution
     *
     * @return BelongsTo
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

    /**
     * 1:n relation: A Person can have many Projects
     *
     * @return HasMany
     */
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
