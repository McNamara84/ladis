<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Device;
use App\Models\Person;

/**
 * Institution Model:
 *
 * - has many Devices (1:n)
 * - has many Persons (1:n)
 */
class Institution extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'contact_information',
    ];

    /**
     * Defines the possible values for the type attribute
     *
     * Corresponds to the ENUM in the database
     * Can be used for validation
     */
    const TYPE_CLIENT      = 'Auftraggeber';
    const TYPE_CONTRACTOR  = 'Auftragnehmer';
    const TYPE_MANUFACTURER = 'Hersteller';

    /**
     * All possible types as an array
     * This can be used for validation or dropdowns
     *
     * @return array<string>
     */
    public static function getTypes(): array
    {
        return [
            self::TYPE_CLIENT,
            self::TYPE_CONTRACTOR,
            self::TYPE_MANUFACTURER,
        ];
    }

    /**
     * 1:n relationship to Device
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    /**
     * 1:n relationship to Person
     */
    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
