<?php

/*
|--------------------------------------------------------------------------
| Site Meta Data
|--------------------------------------------------------------------------
|
| The settings in this file are used to configure the site's metadata.
|
| They affect the generation of the sites metadata (`<head>`) and control
| the bits and pieces of information that's displayed in common locations
| like page headers and footers.
|
*/

return [

    /*
    |--------------------------------------------------------------------------
    | Contact Information
    |--------------------------------------------------------------------------
    |
    | Maps functional roles to contact IDs.
    |
    */

    'contact' => [

        // Primary contact information for the site
        'primary' => env('SITE_CONTACT_PRIMARY', 'fhp'),

        // Competent supervisory authority for the primary contact
        'supervisory_authority' => env('SITE_CONTACT_SUPERVISORY_AUTHORITY', 'mwfk'),

        // Responsible person for the contents of the site
        'responsible' => env('SITE_CONTACT_RESPONSIBLE', 'schmitt-rodermund-eva'),

        // The sites privacy officer
        'privacy' => env('SITE_CONTACT_PRIVACY', 'hirsch-sven'),

        // The site's hosting provider
        'hosting' => env('SITE_CONTACT_HOSTING', 'fhp-it'),


    ],

];
