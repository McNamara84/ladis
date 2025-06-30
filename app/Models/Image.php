<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Condition;
use App\Models\Project;

/**
 * Image Model:
 *
 * - belongs to Condition (n:1)
 * - belongs to Project (n:1)
 * - has one Project (being a cover image) (1:1)
 * - has one Project (being a thumbnail image) (1:1)
 */
class Image extends Model
{
    /**
     * The attributes that aren't mass assignable.
     *
     * @var array<string>
     */
    protected $guarded = ['id', 'created_at','updated_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */

    protected $casts = [
        'project_id' => 'integer',
        'condition_id' => 'integer',
        'uri' => 'string',
        'description' => 'string',
        'alt_text' => 'string',
        'year_created' => 'integer',
        'creator' => 'string',
    ];

    /**
    * n:1 relationship to Condition (backwards)
    */
    public function condition(): BelongsTo
    {
        return $this->belongsTo(Condition::class);
    }

    /**
    * n:1 relationship to Project (backwards)
    */
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    /**
    * 1:1 relationship to Project (being a cover Image)
    */
    public function coverOf(): HasOne
    {
        return $this->hasOne(Project::class, 'cover_image_id');
    }

    /**
    * 1:1 relationship to Project (being a thumbmail image)
    */
    public function thumbnailOf(): HasOne
    {
        return $this->hasOne(Project::class, 'thumbnail_image_id');
    }
}
