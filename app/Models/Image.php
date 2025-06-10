<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'uri' => 'string',
        'description' => 'string',
        'alt_text' => 'string',
        'timestamp' => 'integer',
        'creator' => 'string',
        'project_id' => 'integer',
        'condition_id' => 'integer',
    ];

    /*public function condition()
    *{
    *    return $this->belongsTo(Condition::class);
    }*/

    /* public function project()
    *{
    *    return $this->belongsTo(Project::class);
    }*/

    /*public function coverOf()
    *{
    *    return $this->hasOne(Project::class, 'cover_image_id');
    }*/

    /*public function thumbnailOf()
    *{
    *    return $this->hasOne(Project::class, 'thumbnail_image_id');
    }*/
}
