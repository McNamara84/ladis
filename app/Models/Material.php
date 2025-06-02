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
}
