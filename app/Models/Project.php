<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'project_id',
        'name',
        'description',
        'url',
        'started_at',
        'ended_at',
    ];

    protected $cast = [
    'project_id' => 'integer',
    'name' => 'string',
    'description' => 'string',   //Text is not aviable as a cast type. Instead string?  
    'url' => 'string',
    'started_at' => 'date',  //Date-Format is Y-m-d
    'ended_at' => 'date',
];

        
    //1:1 relation: A Venue belongs to a Project

    public function projects(): BelongsTo
{
    return $this->belongsTo(Project::class);
}

    //1:n relation: A Project has many Venues
    public function venues(): HasMany
{
    return $this->hasMany(Venue::class);
}


    //1:1 relation: A Person belongs to an Project

    public function projects(): BelongsTo
{
    return $this->belongsTo(Project::class);
}

    //1:n relation: A Project has many Persons
    public function persons(): HasMany
{
    return $this->hasMany(Person::class);
}


}
