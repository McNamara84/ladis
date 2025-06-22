<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Person Model
 *
 * Represents a person entity in the system
 */
class Person extends Model
{
    protected $table = 'persons';

    protected $guarded = ['id'];

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
