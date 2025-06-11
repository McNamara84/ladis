<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    //Persons or people? Both of them can be used in English
    protected $table = 'persons';

    protected $guarded = ['id'];
    
    protected $cast = [
        'person_id' => 'integer',
        'name' => 'string', 
    ];


    //1:1 relation: A Person belongs to an Institution

    public function persons(): BelongsTo
{
    return $this->belongsTo(Person::class);
}

    //1:n relation: An Institution has many Persons
    public function institution(): HasMany
{
    return $this->hasMany(Institution::class);
}



}
