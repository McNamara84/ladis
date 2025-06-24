<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Image;
use App\Models\Person;
use App\Models\Venue;

/**
 * Project Model:
 * 
 * - has many Images (1:n)
 * - belongs to Person (n:1)
 * - belongs to Venue (n:1)
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
     * 1:n relationship to Images
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }

    /**
     * 1:1 relationship to Image (as cover image)
     */
    public function coverImage(): HasOne
    {
        return $this->hasOne(Image::class, 'cover_image_id');
    }

    /**
     * 1:1 relationship to Image (as thumbnail image)
     */
    public function thumbnailImage(): HasOne
    {
        return $this->hasOne(Image::class, 'thumbnail_image_id');
    }

    /**
     * n:1 relationship to Person (backwards)
     */
    public function person(): BelongsTo
    {
        return $this->belongsTo(Person::class);
    }

    /**
     * n:1 relationship to Venue (backwards)
     */
    public function venue(): BelongsTo
    {
        return $this->belongsTo(Venue::class);
    }
}
