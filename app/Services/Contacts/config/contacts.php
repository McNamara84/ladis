<?php

/*
|--------------------------------------------------------------------------
| ContactsService Default Configuration
|--------------------------------------------------------------------------
|
| The settings in this file are used to configure the ContactsService.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Cache Configuration
    |--------------------------------------------------------------------------
    |
    | The cache key used to store contacts data in Laravel's cache system.
    |
    */

    'cache_key' => env('CONTACTS_CACHE_KEY', 'contacts'),

    /*
    |--------------------------------------------------------------------------
    | Storage Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for where contact data files are stored and their format.
    |
    */

    'storage' => [

        // The directory where contact JSON files are stored
        'directory' => env('CONTACTS_STORAGE_DIRECTORY', 'contacts'),

        // The file extension for contact data files
        'file_extension' => env('CONTACTS_FILE_EXTENSION', '.json'),

    ],

];
