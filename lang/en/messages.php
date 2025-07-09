<?php

return [
    'test' => 'I love programming.',

    /**
     * --- views/layouts/app.blade.php ---
     */

    // Footer
    '000' => 'Databank for Cleaning Lasers in Surface Restoration<br>Student Project of UAS Potsdam<br>
        <a href=":link00">Privacy Policy</a>',
    '001' => 'Prename Surname, Prename Surname, …<br>Prename Surname, Prename Surname, …',

    /**
     * --- views/welcome.blade.php ---
     */

    // LADIS
    'a00' => ' is an information system for the documentation of laser cleaning methods in the sphere of historical material restoration.',
    'a01' => 'The system was created 2025 by the faculty <a href=":link01">CITY | BUILD | CULTURE</a> in cooperation with the faculty of 
        <a href=":link02">Information Sciences</a> of the <a href=":link03">University of Applied Sciences</a>.',
    
    // Erfasste Daten
    'a02' => 'This information system saves comprehensive datasets from laser cleaning processes for academic research and restoration practice.',

    // Technische Parameter
    'a03' => 'Detailed records about used laser devices, laser optics and their setup.',
    'a04' => 'Recording of artifacts and their materials, damage patterns and preservation conditions before and after the cleaning process. 
        Project data, location data and contributing persons as well as institutions complement the documentation.',
    
    // Funktionen
    'a05' => 'The system provides broad research and analysis features.',
    'a06' => 'Simple search allows quick research with single or multiple keywords.',
    'a07' => 'The advanced search provides diverse filtering and sorting features for detailed research.',

    /**
     * --- views/layouts/user_management.blade.php ---
     */

    'b00' => 'Do you really want to delete the account<strong>{{ :userName }}</strong>?',

    /**
     * --- views/layouts/home.blade.php ---
     */

    // Welcome Header
    'c00' => 'Welcome back, {{ :userName }}!',
    'c01' => 'Manage your laser cleaning databank and your restoration projects.',
    
    // Quick Actions
    'c02' => 'Begin the logging of cleaning laser devices',
    
    // Getting Started
    'c03' => 'Welcome in {{ :appName }}!',
    'c04' => 'Begin the logging of cleaning laser devices and manage them for restoration projects. 
        Caution: The information system is still in development!',

    /**
     * --- views/layouts/inputform_device.blade.php ---
     */

    'd00' => 'Model designation of the laser device, e.g. "CL50"',
    'd01' => 'Build year of the laser device, four-digit',
    'd02' => 'Metrics of the laser device (in mm), no decimal places',
    'd03' => 'Weight of the laser device (in kg), two decimal places',
    'd04' => 'Length of laser device fiber (im m), two decimal places',
    'd05' => 'Maximum and mean power output of the laser device (in Watt)',
    'd06' => 'Maximum wattage of the laser device (in Watt)',
    'd07' => 'Model designation of the machining head, e.g. "OS A20 optics"',
    'd08' => 'Description of the beam profile, e.g. "Top-Hat" or "Gaussian"',
    'd09' => 'Wavelength of the laser device (in nm), no decimal places',
    'd10' => 'Optional decription of important laser device features',

    /**
     * --- views/layouts/inputform_material.blade.php ---
     */

    'e00' => 'Without the selection of a top level material the newly added material is also registered as top level.',

    /**
     * --- views/layouts/inputform_project.blade.php ---
     */

    'f00' => 'Please specify distinct project title.',
    'f01' => 'Please add short project description.',
    'f02' => 'Please specify distinct project URL adress.',
    'f03' => 'Please specify project start date.',
    'f04' => 'Please specify project end date.',

    /**
     * --- views/layouts/confirm.blade.php ---
     */

    'g00' => 'Please confirm your password before continuing.',

    /**
     * --- views/layouts/login.blade.php ---
     */

    'h00' => 'Sign-in into your {{ :appName }} account.',

    /**
     * --- views/layouts/register.blade.php ---
     */

    'i00' => 'Create your {{ :appName }} account.',
    'i01' => 'With the registration you agree on the use of your account data as part of the UAS Potsdam student project.',

    /**
     * --- views/layouts/verify.blade.php ---
     */

    'j00' => 'A fresh verification link has been sent to your email address.',
    'j01' => 'Before proceeding, please check your email for a verification link.',
    'j02' => 'If you did not receive the email',
    'j03' => 'click here to request another',

    /**
     * --- views/layouts/inputform_institution.blade.php ---
     */

    'k00' => 'Please specify formal institution name.',
    'k01' => 'Please choose the correct institution type.',
    'k02' => 'Please add contact information, e.g. a website link.',

];
