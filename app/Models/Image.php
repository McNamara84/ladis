<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Condition;
use App\Models\Project;

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

    public function condition()
    {
        return $this->belongsTo(Condition::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function coverOf()
    {
        return $this->hasOne(Project::class, 'cover_image_id');
    }

    public function thumbnailOf()
    {
        return $this->hasOne(Project::class, 'thumbnail_image_id');
    }
}
