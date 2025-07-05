<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Image;
use App\Models\Person;
use App\Models\Venue;

/**
 * Project Model:
 * 
 * - represents a project entity in the system
 * - has many Images (1:n)
 * - belongs to a Person (n:1)
 * - belongs to a Venue (n:1)
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
        'project_id' => 'integer',
        'started_at' => 'date',
        'ended_at' => 'date',
    ];

    /**
     * 1:n relationship to Images: a Project can have many Images
     *
     * @return HasMany
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * 1:1 relationship to Image (as cover image): a Project can have one cover Image
     *
     * @return BelongsTo
     */
    public function coverImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'cover_image_id');
    }

    /**
     * 1:1 relationship to Image (as thumbnail image): a Project can have one thumbnail Image
     *
     * @return BelongsTo
     */
    public function thumbnailImage(): BelongsTo
    {
        return $this->belongsTo(Image::class, 'thumbnail_image_id');
    }

    /**
     * n:1 relation to Person: a Project belongs to one Person
     * The projects table has a person_id field
     *
     * @return BelongsTo
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * n:1 relationship to Venue: a Project belongs to one Venue
     *
     * @return BelongsTo
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
