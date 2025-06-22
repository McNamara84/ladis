<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Project Model
 *
 * Represents a project entity in the system
 */
class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'url',
        'started_at',
        'ended_at',
    ];

    protected $casts = [
        'project_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
        'url' => 'string',
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
