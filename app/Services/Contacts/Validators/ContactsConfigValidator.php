<?php

namespace App\Services\Contacts\Validators;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * ContactsConfigValidator
 *
 * Validates the ContactsService configuration array.
 *
 * @since 0.2.0
 */
class ContactsConfigValidator
{
    /**
     * Validate the ContactsService configuration array.
     *
     * @param  array<string, mixed>  $config
     * @throws \Illuminate\Validation\ValidationException
     */
    public static function validate(array $config): void
    {
        $rules = [
            // Cache key must be a non-empty string
            'cache_key' => ['required', 'string', 'min:1'],

            // Storage settings must exist
            'storage' => ['required', 'array'],

            // Storage directory must be a valid directory
            'storage.directory' => ['required', 'string', 'min:1'],

            // File extension: must start with a dot and have at least one alphanumeric character
            'storage.file_extension' => [
                'required',
                'string',
                'regex:/^\.[A-Za-z0-9]+$/'
            ],
        ];

        $validator = Validator::make($config, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
