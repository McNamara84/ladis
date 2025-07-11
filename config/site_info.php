<?php

/*
|--------------------------------------------------------------------------
| Site Information
|--------------------------------------------------------------------------
|
| This file contains centralized site information that can be reused across
| multiple views in the application. It should not contain any business
| logic or settings that affect the application's behavior.
|
| This might not be the optimal place to store this information but at least it
| centralizes the information and makes it easier to maintain. A better
| alternative could be to use the database or a dedicated service. Sooner or
| later there will be the demand to edit settings like these via the user
| interface.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Fachhochschule Potsdam
    |--------------------------------------------------------------------------
    |
    | This is the contact information for the Fachhochschule Potsdam.
    |
    */

    'contact_fhp' => [
        'name' => 'Fachhochschule Potsdam',
        'name_adjunct' => 'University of Applied Sciences',
        'name_abbreviation' => 'FHP',
        'street' => 'Kiepenheuerallee 5',
        'postal_code' => '14469',
        'city' => 'Potsdam',
        'phone' => '+49 331 580-00',
        'fax' => '+49 331 580-1009',
        'email' => 'info@fh-potsdam.de',
        'website' => 'https://www.fh-potsdam.de',
    ],

    /*
    |--------------------------------------------------------------------------
    | Ministerium für Wissenschaft, Forschung und Kultur des Landes Brandenburg
    |--------------------------------------------------------------------------
    |
    | This is the contact information for the Ministerium für Wissenschaft,
    | Forschung und Kultur des Landes Brandenburg.
    |
    */

    'contact_mwfk' => [
        'name' => 'Ministerium für Wissenschaft, Forschung und Kultur des Landes Brandenburg',
        'name_abbreviation' => 'MWFK',
        'street' => 'Dortustr. 36',
        'postal_code' => '14467',
        'city' => 'Potsdam',
        'website' => 'https://mwfk.brandenburg.de',
    ],

];
