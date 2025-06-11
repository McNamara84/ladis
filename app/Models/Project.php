<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
    'started_at' => 'date',  //Date-Format is Y-m-d
    'ended_at' => 'date',
];

        
    //1:1 relation: A Person belongs to an Project

    public function projects(): BelongsTo
{
    return $this->belongsTo(Project::class);
}

}
