<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Device;

/**
 * Institution Model
 *
 * Represents an institution entity in the system
 */
class Institution extends Model
{
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
    public const TYPE_CLIENT = 'Auftraggeber';
    public const TYPE_CONTRACTOR = 'Auftragnehmer';
    public const TYPE_MANUFACTURER = 'Hersteller';

    /**
     * All possible types as an array
     * This can be used for validation or dropdowns
     *
     * @return list<string>
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
     * 1:n relation: An Institution can have many Devices
     *
     * @return HasMany
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    /**
     * 1:n relation: An Institution can have many Persons
     *
     * @return HasMany
     */
    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
