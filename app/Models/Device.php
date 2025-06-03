<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Institution;


class Device extends Model
{
    use HasFactory;

    /**
     * 1:n relationship to Institution (backwards)
     */
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
