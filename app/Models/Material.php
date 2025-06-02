<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Material extends Model
{
    // HasFactory enables the use of model factories for testing
    use HasFactory;

    /**
     * The table associated with this model
     *
     * Laravel would automatically assume 'materials' (plural of Material).
     * An explicit definition is optional in this case but makes the code more readable.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable
     *
     * Protection against mass-assignment vulnerabilities
     * Only these fields can be set via create() or update()
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'parent_id',
    ];

    /**
     * Relationship to the parent material
     *
     * BelongsTo relationship: this material "belongs to" a parent material.
     * The foreign key is parent_id in this table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent(): BelongsTo
    {
        // First parameter: the related model
        // Second parameter: the foreign key (optional if it follows the convention)
        // Third parameter: the primary key of the parent model (optional)
        return $this->belongsTo(Material::class, 'parent_id');
    }
}
