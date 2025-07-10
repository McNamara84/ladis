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
     * --- views/user_management.blade.php ---
     */

    'b00' => 'Do you really want to delete the account<strong>{{ :userName }}</strong>?',

    /**
     * --- views/home.blade.php ---
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
     * --- views/inputform_device.blade.php ---
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
     * --- views/inputform_material.blade.php ---
     */

    'e00' => 'Without the selection of a top level material the newly added material is also registered as top level.',

    /**
     * --- views/inputform_project.blade.php ---
     */

    'f00' => 'Please specify distinct project title.',
    'f01' => 'Please add short project description.',
    'f02' => 'Please specify distinct project URL adress.',
    'f03' => 'Please specify project start date.',
    'f04' => 'Please specify project end date.',

    /**
     * --- views/auth/passwords/confirm.blade.php ---
     */

    'g00' => 'Please confirm your password before continuing.',

    /**
     * --- views/auth/login.blade.php ---
     */

    'h00' => 'Sign-in into your {{ :appName }} account.',

    /**
     * --- views/auth/register.blade.php ---
     */

    'i00' => 'Create your {{ :appName }} account.',
    'i01' => 'With the registration you agree on the use of your account data as part of the UAS Potsdam student project.',

    /**
     * --- views/auth/verify.blade.php ---
     */

    'j00' => 'A fresh verification link has been sent to your email address.',
    'j01' => 'Before proceeding, please check your email for a verification link.',
    'j02' => 'If you did not receive the email',
    'j03' => 'click here to request another',

    /**
     * --- views/inputform_institution.blade.php ---
     */

    'k00' => 'Please specify formal institution name.',
    'k01' => 'Please choose the correct institution type.',
    'k02' => 'Please add contact information, e.g. a website link.',

    /**
     * --- views/institutions/index.blade.php ---
     */

    'l00' => 'Do you really want to delete <strong>{{ :institutionName }}</strong>?',

    /**
     * --- views/devices/index.blade.php ---
     */

    'm00' => 'Do you really want to delete <strong>{{ :deviceName }}</strong>?',

    /**
     * --- views/inputform_artifact.blade.php ---
     */

    'n00' => 'Required fields are marked with an <span class="text-danger">*</span> asterisk.',

    /**
     * --- views/site/about.blade.php ---
     */

    'o00' => 'Optimisation of Laser Technology for Cleaning and Desinfection of Historical Surfaces (AZ 35765/01)',
    'o01' => 'A Research Project of the Saxony-Anhalt Cultural Foundation',
    'o02' => 'Die Laserreinigung hat in den vergangenen Jahren einen immer höheren Stellenwert in der Restaurierung historischer
                Oberflächen eingenommen. Um diese Technologie einem noch größeren Kreis anwendender Restaurator*innen zugänglich
                zu machen, bedarf es eines systematischen Erfahrungstransfers, den das hier durch die <a href=":link0">Deutsche 
                Bundesstiftung Umwelt (DBU)</a> unterstützte Projekt der <a href=":link1">Kulturstiftung Sachsen-Anhalt</a> befördern soll.',
    'o03' => 'So wurden aktuell in der Denkmalpflege für verschiedene Reinigungsaufgaben <x-link route="devices.all" 
                text="eingesetzte Lasergeräte" /> anhand von unterschiedlichen Musterflächen vergleichend getestet. Welches Gerät 
                ist für welchen Zweck geeignet und was sind erfolgversprechende Einstellparamater? Im Mittepunkt der Betrachtungen 
                stand der <x-link text="Halberstädter Dom" /> mit seinen stark verkrusteten Kalksteinoberflächen. Aber auch Sandsteine 
                an den <x-link  text="Domen in Magdeburg und Halle" /> sowie Alabasteruntergründe wurden systematisch untersucht.',
    'o04' => 'Ein wesentlicher Pfeiler für die systematische Erfassung umfassender Ergebnisse bildeten verschiedene Qualifikationsarbeiten 
                im Studiengang <a  href=":link"> Konservierung und Restaurierung der FH Potsdam</a>. So wurden materialübergreifend auch 
                verkruste oder mit Graffiti verschmutzte Holzoberflächen zum Gegenstand des Forschungsprojektes. Die für viele Anwender*innen 
                interessanten Ergebnisse sind in vorbildlicher Weise in eine Datenbank im Sinne eines „Offenen Anwendungskataloges“ eingeflossen.',
    'o05' => 'Ein erklärtes Ziel des Projekts ist ein detaillierter <x-link text="Anwendungs- und Einstellungskatalog" />, der
                für typische Verschmutzungsbilder bei unterschiedlichen Materialien sowohl die Oberflächen- und Schadensbeschreibung
                als auch die jeweils optimalen Einstellparameter für unterschiedliche Lasergeräte zusammenfasst.',
    'o06' => 'Der Katalog wurde als fortschreibbare Datenbank konzipiert. Sie ist mit dem Ziel angelegt, eine kontinuierliche
                Erweiterung durch weitere Fachanwender*innen zu ermöglichen.',
    'o07' => 'Erstellt wurde die Datenbank von Studierenden im <a href=":link">Fachbereich Informationswissenschaften der Fachhochschule 
                Potsdam</a> im Rahmen eines Semesterprojekts in enger Zusammenarbeit mit betreuenden Restauratorinnen.',
    'o08' => 'Saxony-Anhalt Cultural Foundation',
    'o09' => 'Construction Department "Halberstadt Dome", Mrs. Weigelt Röseler<br>Am Schloss 4, 39279 Leitzkau',
    'o10' => 'Saxony-Anhalt State Office for Archeology and Historical Monument Preservation',
    'o11' => 'Division for Built and Art Heritage Conservation<br>Department of Monument Exploration, Dip. Conservator Karsten Böhm<br>
                Richard-Wagner-Str. 9, 06114 Halle (Saale)',
    'o12' => 'Dip. Cons. Dr. Corinna Grimm-Remus',
    'o13' => 'Am Schäferbrunnen 12, 39128 Magdeburg',
    'o14' => 'Institute for Diagnostics and Conservation of Heritage in Saxony and Saxony-Anhalt e.V.',
    'o15' => 'Domplatz 3, 06108 Halle',
    'o16' => 'Ulrich Bauer Bornemann',
    'o17' => 'Oberer Stephansberg 37, 96049 Bamberg',
    'o18' => 'Counselor',
    'o19' => 'Prof. Dr. Jeannine Meinhardt<br>Potsdam University of Applied Sciences<br>Kiepenheuerallee 5, 14469 Potsdam',

];
