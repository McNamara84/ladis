<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Material extends Model
{
    // HasFactory enables the use of model factories for testing
    use HasFactory;

    /**
     * The table associated with this model
     *
     * Laravel would automatically assume 'materials' (plural of Material).
     * An explicit definition is optional in this case but makes the code more readable.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable
     *
     * Protection against mass-assignment vulnerabilities
     * Only these fields can be set via create() or update()
     *
     * @var array<string>
     */
    protected $fillable = [
        'name',
        'parent_id',
    ];
}
