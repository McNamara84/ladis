<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Institution;
use App\Models\Project;

/**
 * Person Model:
 *
 * - belongs to Institution (n:1)
 * - has many Projects (1:n)
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

    protected $guarded = ['id'];
    
    protected $casts = [
        'person_id' => 'integer',
        'name' => 'string', 
    ];

/**
 * n:1 relationship to Institution (backwards)
 */
    public function institution(): BelongsTo
{
    return $this->belongsTo(Institution::class);

}

/**
 * 1:n relationship to Project
 */
    public function projects(): HasMany
{
    return $this->hasMany(Project::class);

}

}
