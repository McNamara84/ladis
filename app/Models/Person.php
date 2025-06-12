<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Person extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    protected $casts = [
        'person_id' => 'integer',
        'name' => 'string', 
    ];


    //1:1 relation: A Person belongs to an Institution

    public function institutions(): BelongsTo
{
    return $this->belongsTo(Institution::class);

}



}
