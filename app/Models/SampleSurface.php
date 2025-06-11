<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SampleSurface extends Model
{
    
    use HasFactory;

    protected $table = 'sample_surfaces';
    

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
        
    //1:1 relation: A SampleSurface belongs to an Object

    public function artifacts(): BelongsTo
{
    return $this->belongsTo(Artifact::class);
}

}
