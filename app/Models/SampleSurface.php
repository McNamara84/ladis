<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleSurface extends Model
{

    use HasFactory;

    protected $fillable = [
        'sample_surface_id',
        'name',
        'description',
    ];


    protected $cast = [
        'sample_surface_id' => 'integer',
        'name' => 'string',
        'description' => 'string',
    ];

    //1:n relation: A SampleSurface belongs to an Artifact

    public function artifacts(): HasMany
    {
        return $this->hasMany(Artifact::class);
    }

}
