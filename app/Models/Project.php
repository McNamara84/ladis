<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Project Model
 *
 * Represents a project entity in the system
 */
class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'url',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    /**
     * n:1 relation: A Project belongs to one Person
     * The projects table has a person_id field
     *
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }
}
