<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\PartialSurface;
use Illuminate\Support\Carbon;

/**
 * Material Model:
 *
 * - belongs to (parent) Material (n:1)
 * - has many (children) Materials (1:n)
 * - has many PartialSurfaces (1:n)
 * 
 * @property int $id
 * @property string $name
 * @property int|null $parent_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
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
     * Relationship to the parent material (n:1)
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

    /**
     * Relationship to the child materials (1:n)
     *
     * HasMany relationship: this material "has many" child materials.
     * The foreign key parent_id is in the child materials table.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Material::class, 'parent_id');
    }

    /**
     * Relationship to PartialSurface (1:n)
     */
    public function partialSurfaces(): HasMany
    {
        return $this->hasMany(PartialSurface::class);
    }

    /**
     * Check if a material would create a circular reference
     *
     * This method checks if setting a new parent_id would create a circular relationship.
     * It recursively checks the parent chain.
     *
     * @param int $parentId The ID of the potential new parent
     * @return bool True if it would create a circular reference, false otherwise
     */
    public function wouldCreateCircularReference(int $proposedParentId): bool
    {
        // Check whether the proposed parent is a descendant of this material
        $parent = static::find($proposedParentId);

        if (!$parent) {
            return false;
        }

        // Traverse the ancestors of the proposed parent
        $current = $parent;
        while ($current) {
            // If we encounter ourselves, there is a cycle
            if ($current->parent_id == $this->id) {
                return true;
            }
            $current = $current->parent;
        }

        return false;
    }


    /**
     * Boot method for model events
     *
     * Called automatically by Laravel
     */
    protected static function boot()
    {
        parent::boot();

        // Event listener: before saving (create & update)
        static::saving(function (Material $material) {
            // Prevent a material from being its own parent
            if ($material->parent_id && $material->parent_id == $material->id) {
                throw new \InvalidArgumentException('A material cannot be its own parent.');
            }

            // Prevent circular relationships
            if ($material->parent_id && $material->exists) {
                if ($material->wouldCreateCircularReference($material->parent_id)) {
                    throw new \InvalidArgumentException('This change would create a circular relationship.');
                }
            }

            // Ensure hierarchy depth of maximum two levels
            if ($material->parent_id) {
                $parent = static::find($material->parent_id);

                // Parent must exist and must not itself have a parent
                if ($parent && $parent->parent_id) {
                    throw new \InvalidArgumentException('Only top level materials can be selected as parent.');
                }

                // Material with a parent cannot also have children
                if ($material->exists && $material->children()->exists()) {
                    throw new \InvalidArgumentException('A material with a parent cannot also be a parent.');
                }
            }
        });
    }
}
