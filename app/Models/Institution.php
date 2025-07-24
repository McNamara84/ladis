<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Device;
use App\Models\Person;
use Illuminate\Support\Carbon;

/**
 * Institution Model:
 *
 * - represents an institution entity in the system
 * - has many Devices (1:n)
 * - has many Persons (1:n)
 * 
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string $contact_information
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 */
class Institution extends Model
{
    use HasFactory;

    /**
     * The attributes that are not mass assignable.
     *
     * Protects the 'id' field from mass assignment for security.
     *
     * @var list<string>
     */
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
     * 1:n relation to Device: an Institution can have many Devices
     *
     * @return HasMany
     */
    public function devices(): HasMany
    {
        return $this->hasMany(Device::class);
    }

    /**
     * 1:n relation to Person: an Institution can have many Persons
     *
     * @return HasMany
     */
    public function persons(): HasMany
    {
        return $this->hasMany(Person::class);
    }
}
