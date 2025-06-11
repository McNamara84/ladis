<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SampleSurface extends Model
{
    
    use HasFactory;

    protected $table = 'samplesurfaces';
    

    protected $fillable = [
        'sample_surface_id',
        'name',
        'description',
    ];


    protected $cast = [
        'sample_surface_id' => 'integer',
        'name' => 'string',
        'description' => 'string',   //Text is not aviable as a cast type. Instead string?  
    ];
        
    //1:1 relation: A SampleSurface belongs to an Object

    public function object(): BelongsTo
{
    return $this->belongsTo(Object::class);
}

    //1:n relation: An Object has many SampleSurfaces
    public function samplesurfaces(): HasMany
{
    return $this->hasMany(SampleSurface::class);
}


}
